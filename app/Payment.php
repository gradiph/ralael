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

    protected $dates = [
        'created_at',
        'verified_at',
    ];

    /***************
    | Accessors
    |***************
    */
    public function getFullIdAttribute()
    {
        return 'PA' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    /***************
    | Relations
    |***************
    */
    public function transaction ()
    {
        return $this->belongsTo('App\Transaction');
    }
}
