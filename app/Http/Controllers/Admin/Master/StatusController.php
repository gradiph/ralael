<?php

namespace App\Http\Controllers\Admin\Master;

use App\Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return view('admin.master.status.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Status $status)
    {
        //
    }

    public function edit(Status $status)
    {
        //
    }

    public function update(Request $request, Status $status)
    {
        //
    }

    public function destroy(Status $status)
    {
        //
    }

    public function dataList(Request $request)
    {
        $statuses = Status::orderBy('order', 'asc')
            ->get();

        return view('admin.master.status.list')->with([
            'statuses' => $statuses,
        ]);
    }
}
