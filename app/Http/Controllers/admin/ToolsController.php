<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\tools;
use Illuminate\Http\Request;

class ToolsController extends Controller
{
    public function index()
    {
        $tools = tools::all();
        return view('backend.tools.index', compact('tools'));
    }

    public function add()
    {
        return view('backend.tools.add');
    }


    public function save(Request $req)
    {

        $add = new tools();
        $add->tool_name = $req->tool_name;
        $add->slug = $req->slug;
        $add->status = $req->status;
        $add->order = $req->order;
        $add->save();


        return back()->with('success', 'Tool Added !');

    }

    public function edit($id)
    {
        $tool = tools::where('id', $id)->first();
        return view('backend.tools.edit', compact('tool'));
    }


    public function update(Request $req, $id)
    {
        $add = tools::findOrFail($id);
        $add->tool_name = $req->tool_name;
        $add->slug = $req->slug;
        $add->status = $req->status;
        $add->order = $req->order;
        $add->update();


        return back()->with('success', 'Tool updated !');
    }
}