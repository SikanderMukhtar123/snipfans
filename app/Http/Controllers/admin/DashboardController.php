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


        // Get the views data grouped by month (from 'created_at' or another column)
        $monthlyViews = tools::selectRaw('MONTH(created_at) as month, SUM(view) as total_views')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Format the data for the chart (e.g., month names and view counts)
        $formattedData = [];
        foreach ($monthlyViews as $data) {
            $formattedData[] = [
                'x' => date('M', mktime(0, 0, 0, $data->month, 10)),  // Get the month abbreviation (e.g., Jan, Feb)
                'y' => $data->total_views  // The total views for that month
            ];
        }


        return view('backend.dashboard' , compact('tools' , 'toolsViews' , 'formattedData'));
    }
}
