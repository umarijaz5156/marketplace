<?php

namespace App\Actions\Fortify;

use App\Enums\EmailTemplateType;
use App\Models\AffiliateConfig;
use App\Models\AffiliateUsers;
use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cookie;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        Validator::make($input, [
            'name' => ['required', 'regex:/^[a-zA-Z]([._-](?![._-])|[a-zA-Z0-9]){1,15}[a-zA-Z0-9]$/' ,'string' ,'min:3', 'max:17', 'unique:common_database.users'],
            'email' => ['required', 'regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/','string', 'email', 'max:100', 'unique:common_database.users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],
        [
            'password.regex' => 'Passowrd: Minimum eight characters, at least one letter, one number and one special character required',
            'name.regex' => 'Username must not contain spaces and characters at start and end.'
        ])->validate();


         //TODO:: change ip address to server reques
        //  $ip = request()->ip();

        $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=39.34.149.255'));

        $new_user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'timezone' => $location['geoplugin_timezone'],
            'password' => Hash::make($input['password']),
        ]);

        // make affilaite user

        if(request()->cookie('affiliate_key')){

            $name = explode('_',request()->cookie('affiliate_key'));
            $affiliate = User::where('name', $name[1])->first();
            if($affiliate){
                AffiliateUsers::create([
                    'user_id' => $new_user->id,
                    'affiliate_id' => $affiliate->id,
                    'commission' => 0,
                ]);
                Cookie::queue( Cookie::forget('affiliate_key'));
            }

        }

        if($mailData = Newsletter::where('type', EmailTemplateType::UserRegistered->value)->first()){

            $body = str_replace('{{user}}', $new_user->name, $mailData->body);
            $body = str_replace('{{email}}', $new_user->email, $body);

            $data = ['body' => $body, 'subject' => $mailData->subject];

            dispatch(new \App\Jobs\SendEmailJob($data, $new_user->email));
        }


        return $new_user;
    }


}

