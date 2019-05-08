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
    | Accessors
    |***************
    */
    public function getFullIdAttribute()
    {
        return 'CA' . str_pad($this->id, 2, '0', STR_PAD_LEFT);
    }

    /***************
    | Relations
    |***************
    */
    public function items ()
    {
        return $this->hasMany('App\Item');
    }
}
