<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipient extends Model
{
    use SoftDeletes;

    public $timestamps = FALSE;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'urban',
        'subdistrict',
        'city',
        'province',
        'post_code',
    ];

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
