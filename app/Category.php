<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

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
        return $this->hasMany('App\Item');
    }
}
