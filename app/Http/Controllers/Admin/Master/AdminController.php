<?php

namespace App\Http\Controllers\Admin\Master;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.master.admin.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Admin $admin)
    {
        //
    }

    public function edit(Admin $admin)
    {
        //
    }

    public function update(Request $request, Admin $admin)
    {
        //
    }

    public function destroy(Admin $admin)
    {
        //
    }

    public function dataList(Request $request)
    {
        $admins = Admin::get();

        return view('admin.master.admin.list')->with([
            'admins' => $admins,
        ]);
    }
}
