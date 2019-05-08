<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'qty',
        'price',
        'description',
    ];

    /***************
    | Accessors
    |***************
    */
    public function getFullIdAttribute()
    {
        return 'IT' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    /***************
    | Relations
    |***************
    */
    public function category ()
    {
        return $this->belongsTo('App\Category');
    }

    public function carts ()
    {
        return $this->hasMany('App\Cart');
    }

    public function images ()
    {
        return $this->hasMany('App\Image');
    }

    public function tags ()
    {
        return $this->belongsToMany('App\Tag')->using('App\ItemTag');
    }

    public function transactions ()
    {
        return $this->belongsToMany('App\Transaction')->using('App\ItemTransaction')->withPivot('qty', 'price', 'note');
    }
}
