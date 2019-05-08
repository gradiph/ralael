<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'cash',
        'facebook_uid',
        'google_uid',
        'twitter_uid',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /***************
    | Accessors
    |***************
    */
    public function getFullIdAttribute()
    {
        return 'US' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    /***************
    | Relations
    |***************
    */
    public function recipients ()
    {
        return $this->hasMany('App\Recipient');
    }

    public function transactions ()
    {
        return $this->hasMany('App\Transaction');
    }

    public function carts ()
    {
        return $this->hasMany('App\Cart');
    }

    public function logs ()
    {
        return $this->morphMany('App\Log', 'logable');
    }

    public function cashflows ()
    {
        return $this->hasMany('App\Cashflow');
    }
}
