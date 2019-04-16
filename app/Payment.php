<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = FALSE;

    protected $fillable = [
        'transaction_id',
        'value',
        'address',
        'created_at',
        'verified_at',
    ];

    /***************
    | Relations
    |***************
    */
    public function transaction ()
    {
        return $this->belongsTo('App\Transaction');
    }
}
