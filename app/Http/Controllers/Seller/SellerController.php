<?php

namespace App\Http\Controllers\Seller;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Seller\Seller;
use Laravel\Jetstream\Jetstream;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\StatefulGuard;
use App\Actions\Fortify\PasswordValidationRules;
use App\Enums\EmailTemplateType;
use App\Enums\OrderStatus;
use App\Models\Newsletter;
use App\Models\Seller\Gig;
use App\Models\Seller\SellerProfile;
use App\Models\Seller\SellerQualification;
use App\Models\Seller\SellerStat;
use App\Models\Seller\Skill;
use Illuminate\Support\Facades\Http;

class SellerController extends Controller
{

     /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    use PasswordValidationRules;

     /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }


    /**
     * Show create form for seller registeration
     */
    public function show()
    {
        if(Auth::check()){
            if (Auth::user()->is_seller){
                return redirect(route('seller-dashboard'));
            }
        }
        // get auto location of user

        //TODO:: change ip address to server request
        $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=39.34.149.255'));

        if(isset($location['geoplugin_countryCode'])){
            $cc = $location['geoplugin_countryCode'];
            $country = Country::where('code', $cc)->first();
        }
        $country = isset($country) ? $country->id : "";
        $countries = Country::all()->sortBy('name');

        // set skills
        $skills = Skill::all()->sortBy('name');

        return view('auth.seller-register', ['countries' => $countries, 'country' => $country, 'skills' => $skills]);
    }



    public function createSeller(Request $request)
    {

        Validator::make(
            $request->all(),
            [
                'first_name' => ['required','regex:/^[a-zA-z]*$/', 'nullable'],
                'last_name' => ['required','regex:/^[a-zA-z]*$/', 'nullable'],
                'seller_name' => ['required', 'regex:/^[a-zA-Z]([._-](?![._-])|[a-zA-Z0-9]){1,15}[a-zA-Z0-9]$/', 'string', 'min:3', 'max:17', 'unique:sellers'],
                'country' => ['required'],
                'phone_number' => ['required', 'regex:/^\+(?:[0-9].?){6,14}[0-9]$/'],

                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            ],
            [

                'seller_name.regex' => 'Seller name must not contain spaces and characters at start and end',
                'phone_number.regex' => 'Phone number must not contain spaces and start with +',

            ]
        )->validate();

        $user = User::find(Auth::user()->id);


        // update user
        $user->is_seller = true;
        $user->save();
        // create seller
        $seller = Seller::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'seller_name' => $request['seller_name'],
            'user_id' => $user['id'],

        ]);
        // attach skills
        if(isset($request['skills']) && sizeof($request['skills']) > 0){
            foreach($request['skills'] as $skill){
                $savedSkill = Skill::where('name',$skill)->first();
                if($savedSkill) {
                    $seller->skills()->attach($savedSkill);
                } else{
                   $newSkill = Skill::create([
                        'name' => $skill
                    ]);
                    $seller->skills()->attach($newSkill);
                }
            }

        }

        // create seller profile

        $sellerProfile = [
            'description' => $request['description'],
            'address_line1' => $request['address_line1'],
            'address_line2' => $request['address_line2'],
            'country_id' => $request['country'],
            'phone' => $request['phone_number'],
            'seller_id' => $seller['id']
        ];
        SellerProfile::create($sellerProfile);

        // attach seller stats
        $sellerStats = new SellerStat;
        $seller->sellerStat()->save($sellerStats);

        // save seller qualitfications

        $qualifications  = [];
        foreach($request['title'] as $index => $title){
            $qualifications['title'] = $title;
            $qualifications['institute'] = isset($request['institute'][$index])  ? $request['institute'][$index] : ' ';
            $qualifications['seller_id'] = $seller->id;
            SellerQualification::create($qualifications);
       }

        // send email to seller
        if($mailData = Newsletter::where('type', EmailTemplateType::SellerRegistered->value)->first()){
            $body = str_replace('{{seller}}', $seller->seller_name, $mailData->body);
            $body = str_replace('{{email}}', $seller->user->email, $body);

            $data = ['body' => $body, 'subject' => $mailData->subject];

            dispatch(new \App\Jobs\SendEmailJob($data, $seller->user->email));
        }
        if(session()->has('url.intended')){
            return redirect(session()->get('url.intended'));
        }
        $request->session()->regenerate();

        return redirect(route('seller-dashboard'));

    }

    public function profileDetail($name)
    {

        $seller = Seller::with(['orders'=>function($query){
            $query->select('id','seller_id','created_at')->where('status', OrderStatus::Completed->value)->latest();
        }])->where('seller_name', $name)->firstOrFail();

        $gigs = Gig::with(['gigDetail','seller','gigReviews','gigPackages'])->where('seller_id', $seller->id)->where('is_approved', true)->where('is_active', true)->get();

        return view('seller.profile', compact('seller', 'gigs'));
    }
}
