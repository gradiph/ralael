<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('admin.transaction.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Transaction $transaction)
    {
        //
    }

    public function edit(Transaction $transaction)
    {
        //
    }

    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    public function destroy(Transaction $transaction)
    {
        //
    }

    public function dataList (Request $request)
    {
        $transactions = Transaction::get();

        return view('admin.transaction.list')->with([
            'transactions' => $transactions,
        ]);
    }
}
