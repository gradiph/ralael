<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Cart;
use App\Item;
use App\Log;
use App\Recipient;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    public function index ()
    {
        return view('welcome');
    }

    public function item (Item $item)
    {
        $item->load(['images', 'tags']);

        return view('item')->with([
            'item' => $item,
        ]);
    }

    public function cartPost (Request $request)
    {
        if (Auth::check())
        {
            //cek apakah item sudah ada di cart
            $cart = Cart::currentUser()
                ->where('item_id', $request->item_id)
                ->first();

            if (filled($cart))
            {
                $cart->qty += 1;
                $cart->save();
            }
            else
            {
                Cart::create([
                    'user_id' => Auth::id(),
                    'item_id' => $request->item_id,
                    'qty' => 1,
                    'note' => '',
                ]);
            }
        }
        else
        {
            //simpan session ke $carts untuk diolah
            $carts = session('carts');

            //cek apakah item sudah ada di cart
            if (Arr::has(session('carts'), $request->item_id))
            {
                //qty item yg diminta ditambah 1
                Arr::set($carts, $request->item_id . '.qty', Arr::get($carts, $request->item_id . '.qty') + 1);
            }
            else
            {
                //buat baru
                $carts[$request->item_id] = [
                    'qty' => 1,
                    'note' => '',
                ];
            }

            //simpan $carts ke session kembali
            session(['carts' => $carts]);
        }

        return redirect()->route('cart');
    }

    public function cart ()
    {
        if (Auth::check())
        {
            $carts = Cart::currentUser()
                ->get();

            if (empty($carts) && session()->has('carts'))
            {
                foreach (session('carts') as $key => $value)
                {
                    Cart::create([
                        'user_id' => Auth::id(),
                        'item_id' => $key,
                        'qty' => $value['qty'],
                        'note' => $value['note'],
                    ]);
                }

                session()->forget('carts');

                $carts = Cart::currentUser()
                    ->get();
            }
        }
        else
        {
            $carts = session('carts');

            if (filled($carts))
            {
                foreach ($carts as $key => $value)
                {
                    $item = Item::find($key);

                    Arr::set($carts, $key . '.item', $item);
                }
            }
        }

        return view('cart')->with([
            'carts' => $carts,
        ]);
    }

    public function checkout ()
    {
        $recipients = Recipient::currentUser()
            ->latest('updated_at')
            ->get();

        $carts = Cart::currentUser()
            ->get();

        return view('checkout')->with([
            'recipients' => $recipients,
            'carts' => $carts,
        ]);
    }

    public function checkoutPost (Request $request)
    {
        DB::beginTransaction();

        //buat data penerima
        $recipient = Recipient::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'urban' => $request->urban,
            'subdistrict' => $request->subdistrict,
            'city' => $request->city,
            'province' => $request->province,
            'post_code' => $request->post_code,
        ]);
        if (empty($recipient))
        {
            $error = 'E137';
            goto error;
        }

        //buat transaksi
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'recipient_id' => $recipient->id,
        ]);
        if (empty($transaction))
        {
            $error = 'E138';
            goto error;
        }

        //tambahkan item ke transaksi
        $carts = Cart::currentUser()->get();
        foreach ($carts as $cart)
        {
            $beforeAttach = $transaction->items()->count();

            $transaction->items()->attach($cart->item_id, [
                'qty' => $cart->qty,
                'price' => $cart->item->price,
                'note' => $cart->note,
            ]);

            $afterAttach = $transaction->items()->count();

            if ($afterAttach <= $beforeAttach)
            {
                $error = 'E139';
                goto error;
            }
        }

        //hapus keranjang belanja
        if (! Cart::currentUser()->delete())
        {
            $error = 'E141';
            goto error;
        }

        //buat data log
        $log = Log::create([
            'logable_id' => Auth::id(),
            'logable_type' => 'users',
            'description' => 'membuat transaksi ID #' . $transaction->full_id,
            'created_at' => now(),
        ]);
        if (empty($log))
        {
            $error = 'E148';
            goto error;
        }

        DB::commit();
        return redirect()->route('transactions.show', ['transaction' => $transaction->id]);

        error:
        DB::rollBack();
        return back()->withInput->with([
            'alert_type' => 'alert-danger',
            'alert_title' => 'Gagal!',
            'alert_message' => 'Pembelian gagal dibuat. &mdash; ' . $error,
        ]);
    }
}
