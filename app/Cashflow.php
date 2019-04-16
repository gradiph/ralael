<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    public $timestamps = FALSE;

    protected $fillable = [
        'user_id',
        'value',
        'description',
        'created_at',
    ];

    /***************
    | Relations
    |***************
    */
    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}
