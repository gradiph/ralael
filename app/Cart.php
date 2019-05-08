<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
        'qty',
        'note',
    ];

    /***************
    | Accessors
    |***************
    */
    public function getPriceTotalAttribute()
    {
        return $this->qty * $this->item->price;
    }

    /***************
    | Scopes
    |***************
    */
    public function scopeCurrentUser($query)
    {
        return $query->where('user_id', Auth::id());
    }

    /***************
    | Relations
    |***************
    */
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function item ()
    {
        return $this->belongsTo('App\Item');
    }
}
