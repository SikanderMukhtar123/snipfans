<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tools;

class FrontendController extends Controller
{
    public function index()
    {
        $tools = tools::where('status', '1')->orderBy('order', 'asc')->get();
        return view('frontend.index', compact('tools'));
    }
}
