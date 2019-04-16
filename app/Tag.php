<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = FALSE;

    protected $fillable = [
        'name',
    ];

    /***************
    | Relations
    |***************
    */
    public function items ()
    {
        return $this->belongsToMany('App\Item');
    }
}
