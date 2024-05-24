<?php

namespace App\Models\Seller;

use App\Models\User;
use App\Models\Seller\Gig;
use App\Models\Order\Order;
use App\Models\StripeToken;
use Illuminate\Support\Str;
use App\Models\ChatCenter\Chat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Seller extends Model
{

    use HasFactory;
    use Notifiable;
    protected $connection = 'mysql';
     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'seller_name',
        'is_approved',
        'gigs_count',
        'seller_level',
        'joined_on',
        'user_id',
        'stripe_connect_id',
        'stripe_onboarded',
        'withdraw_type',
        'withdraw_email',
        'verification_status'
    ];

    protected $dates = [
        'created_at',
        'update_at',
        'joined_on'
    ];

    public function addToken()
    {
        $token = Str::random(32);
         StripeToken::create([
            'seller_id' => $this->id,
            'token' => $token
        ]);
        return $token;
    }

    // one to one relation with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // one to one relation with sellers profile table
    public function sellerProfile()
    {
        return $this->hasOne(SellerProfile::class);
    }

    // many to many relation with skills
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    // relation with seller stats
    public function sellerStat()
    {
        return $this->hasOne(SellerStat::class);
    }

    // one to many relation with gigs
    public function gigs()
    {
        return $this->hasMany(Gig::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // relation with chat
    public function chats() {
        return $this->hasMany(Chat::class);
    }

    public function stripeToken()
    {
        return $this->hasOne(StripeToken::class);
    }

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'sellers.'.$this->id;
    }

    public function qualifications(){
        return $this->hasMany(SellerQualification::class);
    }
}
