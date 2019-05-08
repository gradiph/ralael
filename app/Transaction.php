<?php

namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'recipient_id',
    ];

    /***************
    | Accessors
    |***************
    */
    public function getFullIdAttribute()
    {
        return 'TR' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    public function getQtyTotalAttribute()
    {
        return $this->items()->sum('item_transaction.qty');
    }

    public function getPriceTotalAttribute()
    {
        $total = DB::table('item_transaction')
            ->where('transaction_id', $this->id)
            ->selectRaw('sum(qty * price) as price')
            ->groupBy('transaction_id')
            ->first();

        return $total->price;
    }

    public function getPaymentTotalAttribute()
    {
        return $this->payments()->sum('value');
    }

    public function getRecipientNameAttribute()
    {
        return $this->recipient->name;
    }

    public function getStatusNameAttribute()
    {
        if (empty($this->status))
        {
            return 'Transaksi dibuat.';
        }
        else
        {
            $status = DB::table('status_transaction')
                ->select('statuses.name')
                ->join('statuses', 'statuses.id', '=', 'status_transaction.status_id')
                ->where('transaction_id', $this->id)
                ->latest('creation_time')
                ->first();

            return $status->name;
        }
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
