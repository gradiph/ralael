<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'urban',
        'subdistrict',
        'city',
        'province',
        'post_code',
    ];

    /***************
    | Scopes
    |***************
    */
    public function scopeCurrentUser($query)
    {
        return $query->where('user_id', Auth::id());
    }

    /***************
    | Relations
    |***************
    */
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function transactions ()
    {
        return $this->hasMany('App\Transaction');
    }
}
