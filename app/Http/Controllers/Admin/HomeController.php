<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Admin;
use App\Http\Controllers\Controller;
use App\Log;
use Auth;
use DB;

class HomeController extends Controller
{
    public function index ()
    {
        return view('admin.home');
    }

    public function passwordChange ()
    {
        return view('admin.password_change');
    }

    public function passwordChangePost (Request $request)
    {
        DB::beginTransaction();

        //ubah password
        $admin = Admin::find(Auth::guard('admin')->id());
        $admin->password = bcrypt($request->new_password);
        if (! $admin->save())
        {
            $error = 'E309';
            goto error;
        }

        //buat data log
        $log = Log::create([
            'logable_id' => Auth::guard('admin')->id(),
            'logable_type' => 'admins',
            'description' => 'mengubah password',
            'created_at' => now(),
        ]);
        if (empty($log))
        {
            $error = 'E311';
            goto error;
        }

        DB::commit();
        return redirect()->route('admin.password.change')->with([
            'alert_type' => 'alert-success',
            'alert_title' => 'Berhasil!',
            'alert_message' => 'Password berhasil diubah.',
        ]);

        error:
        DB::rollBack();
        return back()->withInput->with([
            'alert_type' => 'alert-danger',
            'alert_title' => 'Gagal!',
            'alert_message' => 'Password gagal diubah. &mdash; ' . $error,
        ]);
    }
}
