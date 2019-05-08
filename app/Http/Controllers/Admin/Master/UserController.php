<?php

namespace App\Http\Controllers\Admin\Master;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.master.user.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }

    public function dataList(Request $request)
    {
        $users = User::get();

        return view('admin.master.user.list')->with([
            'users' => $users,
        ]);
    }
}
