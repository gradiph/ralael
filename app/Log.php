<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = FALSE;

    protected $fillable = [
        'logable_id',
        'logable_type',
        'description',
        'created_at',
    ];

    /***************
    | Relations
    |***************
    */
    public function logable()
    {
        return $this->morphTo();
    }
}
