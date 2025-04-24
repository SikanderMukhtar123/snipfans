<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\tools;

class facebookVideoController extends Controller
{
    public function index()
    {
        return view('frontend.downloader.fb.index');
    }

    public function video(Request $req)
    {
        $videoUrl = $req->input('videoUrl');
    
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-rapidapi-host' => 'free-facebook-downloader.p.rapidapi.com',
            'x-rapidapi-key' => 'd175f87ac7msh9ad456be4af15b1p10b496jsn45e43437f091',
        ])->post('https://free-facebook-downloader.p.rapidapi.com/external-api/facebook-video-downloader', [
            'url' => $videoUrl
        ]);
    
        $data = $response->json();
    
        if (isset($data['success']) && $data['success'] === true) {
            return response()->json([
                'video_id' => $data['id'] ?? null,
                'title' => $data['title'] ?? null,
                'sd_video_url' => $data['links']['Download Low Quality'] ?? null,
                'hd_video_url' => $data['links']['Download High Quality'] ?? null,
            ]);
        } else {
            return response()->json([
                'error' => 'Video could not be retrieved. Please check the URL or try again later.'
            ], 404);
        }
    }



    public function views(Request $request)
    {

        $tools = tools::where('slug', '/facebook-video-downloader')->first();
        $tools->view = $tools->view + 1;
        $tools->save();

        return response()->json([
            'views' => $tools->view
        ]);
    }

    
}
