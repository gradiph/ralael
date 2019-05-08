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
    | Accessors
    |***************
    */
    public function getFullIdAttribute()
    {
        return 'ST' . str_pad($this->id, 2, '0', STR_PAD_LEFT);
    }

    /***************
    | Relations
    |***************
    */
    public function transactions ()
    {
        return $this->belongsToMany('App\Transaction')->using('App\StatusTransaction')->withPivot('admin_id', 'description', 'creation_time');
    }
}
