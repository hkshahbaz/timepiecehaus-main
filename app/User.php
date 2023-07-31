<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Notifications\VerifyApiEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use LaratrustUserTrait, Notifiable, SoftDeletes,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'first_name', 'last_name', 'company', 'email', 'password', 'gender', 'date_of_birth', 'phone_no', 'mobile_no', 'fax_no', 'street', 'display_name',
        'street_line_2', 'zip_code', 'city', 'state', 'country_id', 'occupation', 'timezone_id', 'language_id', 'about', 'picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function sendMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }

    public function userOrder()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // one user can have multiple wish lists
    public function wishLists()
    {
        return $this->hasMany(WishList::class);
    }

    //one user can have multiple products in wish list
    public function wishListProducts()
    {
        return $this->belongsToMany(Product::class, 'wish_lists', 'user_id', 'product_id');
    }

    public function orderRequests()
    {
        return $this->hasMany(Order::class, 'vendor_id');
    }

    public function myOrders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function userSetting()
    {
        return $this->hasOne(UserSetting::class, 'user_id');
    }

    public function suspiciousReports()
    {
        return $this->hasMany(SuspiciousReport::class);
    }

    public function sendApiEmailVerificationNotification()
    {
    $this->notify(new VerifyApiEmail); // my notification
    }
}
