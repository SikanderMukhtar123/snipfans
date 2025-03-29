<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tools;

class DashboardController extends Controller
{
    public function index()
    {
        $tools = tools::count();
        $toolsViews = tools::sum('view');
        return view('backend.dashboard' , compact('tools' , 'toolsViews'));
    }
}
