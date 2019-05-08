<?php

namespace App\Http\Controllers\Admin\Master;

use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('admin.master.tag.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Tag $tag)
    {
        //
    }

    public function edit(Tag $tag)
    {
        //
    }

    public function update(Request $request, Tag $tag)
    {
        //
    }

    public function destroy(Tag $tag)
    {
        //
    }

    public function dataList(Request $request)
    {
        $tags = Tag::get();

        return view('admin.master.tag.list')->with([
            'tags' => $tags,
        ]);
    }
}
