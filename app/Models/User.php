<?php

namespace App\Models;

use App\Models\ChatCenter\Chat;
use App\Models\Order\Order;
use App\Models\Seller\Seller;
use App\Models\Ticket\Ticket;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $connection = 'common_database';

    protected $fillable = [
        'name',
        'email',
        'is_seller',
        'is_admin',
        'password',
        'timezone',
        'is_banned',
        'is_affiliate',
        'affiliate_link',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_online',
        'timezone',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    // user reviews sent
    public function reviewsSent()
    {
        return $this->hasMany(Review::class, 'to_user_id');
    }

    // user reviews received
    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'from_user_id');
    }
    // user one to many relation with chat
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    // user one to many relation with ticket
    public function tickets()
    {
        return $this->hasMany(Ticket::class,'ticket_manager_id');
    }

    // user one to many relation with order
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function ticketManager()
    {
        return $this->hasMany(Ticket::class, 'ticket_manager_id');
    }

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'users.'.$this->id;
    }

    public function affiliates()
    {
        return $this->hasMany(AffiliateUsers::class, 'affiliate_id');
    }

    public function isOnline()
    {
        return DB::connection('common_database')->table('sessions')->where('user_id', $this->id)->exists();
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
}
