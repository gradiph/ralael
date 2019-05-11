<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Log;
use App\Payment;
use App\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create()
    {
        $transactions = Transaction::currentUser()->get();

        return view('payment.create')->with([
            'transactions' => $transactions,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        //simpan file bukti pembayaran
        if (! $request->hasFile('file'))
        {
            $error = 'E231';
            goto error;
        }
        if (! $request->file('file')->isValid())
        {
            $error = 'E232';
            goto error;
        }
        $request->file->storePublicly('payment', 'uploads');
        $filename = $request->file->hashName();

        //buat data payment
        $payment = Payment::create([
            'transaction_id' => $request->transaction_id,
            'value' => $request->value,
            'address' => $filename,
            'created_at' => now(),
            'verified_at' => NULL,
        ]);
        if (empty($payment))
        {
            $error = 'E233';
            goto error;
        }

        //buat data log
        $log = Log::create([
            'logable_id' => Auth::id(),
            'logable_type' => 'users',
            'description' => 'membuat pembayaran ID #' . $payment->full_id,
            'created_at' => now(),
        ]);
        if (empty($log))
        {
            $error = 'E234';
            goto error;
        }

        DB::commit();
        return redirect()->route('transactions.show', ['transaction' => $request->transaction_id]);

        error:
        DB::rollBack();
        return back()->withInput->with([
            'alert_type' => 'alert-danger',
            'alert_title' => 'Gagal!',
            'alert_message' => 'Pembayaran gagal dibuat. &mdash; ' . $error,
        ]);
    }
}
