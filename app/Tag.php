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
    | Accessors
    |***************
    */
    public function getFullIdAttribute()
    {
        return 'TA' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    /***************
    | Relations
    |***************
    */
    public function items ()
    {
        return $this->belongsToMany('App\Item');
    }
}
