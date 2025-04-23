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
            'x-rapidapi-host' => 'facebook-videos-reels-downloader.p.rapidapi.com',
            'x-rapidapi-key' => 'd175f87ac7msh9ad456be4af15b1p10b496jsn45e43437f091',
        ])->get('https://facebook-videos-reels-downloader.p.rapidapi.com/get-video-info', [
            'url' => $videoUrl,
        ]);

        $data = $response->json();

        if (isset($data['video'])) {
            return response()->json([
                'video_id' => $data['video']['video_id'],
                'thumbnail' => $data['video']['thumbnail_url'],
                'sd_video_url' => $data['video']['sd_video_url'] ?? null,
                'hd_video_url' => $data['video']['hd_video_url'] ?? null,
            ]);
        } else {
            return response()->json(['error' => 'Video URL not found or not supported.'], 404);
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
