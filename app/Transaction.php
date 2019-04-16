<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'recipient_id',
    ];

    /***************
    | Relations
    |***************
    */
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function recipient ()
    {
        return $this->belongsTo('App\Recipient');
    }

    public function payments ()
    {
        return $this->hasMany('App\Payment');
    }

    public function items ()
    {
        return $this->belongsToMany('App\Item')->using('App\ItemTransaction')->withPivot('qty', 'price', 'note');
    }

    public function statuses ()
    {
        return $this->belongsToMany('App\Status')->using('App\StatusTransaction')->withPivot('admin_id', 'description', 'creation_time');
    }
}
