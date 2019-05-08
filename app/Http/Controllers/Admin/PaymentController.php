<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('admin.payment.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Payment $payment)
    {
        //
    }

    public function edit(Payment $payment)
    {
        //
    }

    public function update(Request $request, Payment $payment)
    {
        //
    }

    public function destroy(Payment $payment)
    {
        //
    }

    public function dataList (Request $request)
    {
        $payments = Payment::get();

        return view('admin.payment.list')->with([
            'payments' => $payments,
        ]);
    }
}
