<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps = FALSE;

    protected $fillable = [
        'item_id',
        'order',
        'title',
        'address',
    ];

    /***************
    | Relations
    |***************
    */
    public function item ()
    {
        return $this->belongsTo('App\Item');
    }
}
