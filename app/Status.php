<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;

    public $timestamps = FALSE;

    protected $fillable = [
        'order',
        'name',
    ];

    /***************
    | Relations
    |***************
    */
    public function transactions ()
    {
        return $this->belongsToMany('App\Transaction')->using('App\StatusTransaction')->withPivot('admin_id', 'description', 'creation_time');
    }
}
