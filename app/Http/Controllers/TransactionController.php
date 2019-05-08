<?php

namespace App\Http\Controllers;

use App\Status;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::currentUser()
            ->get();

        return view('transaction.index')->with([
            'transactions' => $transactions,
        ]);
    }

    public function show (Transaction $transaction)
    {
        $transaction->load([
            'items' => function ($query) {
                $query->withTrashed();
            },
            'statuses' => function ($query) {
                $query->withTrashed();
            },
            'payments' => function ($query) {
                $query->orderBy('created_at', 'asc');
            },
        ]);

        return view('transaction.show')->with([
            'transaction' => $transaction,
        ]);
    }

    public function dataList (Request $request)
    {
        //
    }
}
