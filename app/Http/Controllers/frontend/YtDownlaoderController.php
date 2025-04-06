<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class YtDownlaoderController extends Controller
{
    protected $youtubeApiKey = 'AIzaSyB8D7eccyAP7MEoyx5-qB_VKFFPHcsoDtg';

    public function index()
    {
        return view('frontend.downloader.yt.index');
    }

    public function download(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $videoUrl = $request->url;

        // Extract video ID
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $videoUrl, $matches);
        if (!isset($matches[1])) {
            return response()->json(['error' => 'Invalid YouTube URL'], 400);
        }

        $videoId = $matches[1];

        // Get video info from yt-dlp
        $escapedUrl = escapeshellarg($videoUrl);
        $output = shell_exec("yt-dlp -J $escapedUrl");

        if (!$output) {
            return response()->json(['error' => 'yt-dlp failed'], 500);
        }

        $info = json_decode($output, true);
        if (json_last_error() !== JSON_ERROR_NONE || empty($info)) {
            return response()->json(['error' => 'Invalid JSON from yt-dlp'], 500);
        }

        // Pick best formats
        $formats = collect($info['formats']);

        $noWatermark = $formats->first(fn($f) => $f['format_id'] === '18'); // mp4 360p
        $watermark   = $formats->first(fn($f) => $f['format_id'] === '22'); // mp4 720p
        $hd          = $formats->first(fn($f) => $f['format_id'] === '137'); // 1080p (video-only)

        return response()->json([
            'title'         => $info['title'] ?? '',
            'thumbnail'     => $info['thumbnail'] ?? '',
            'no_watermark'  => $noWatermark['url'] ?? null,
            'watermark'     => $watermark['url'] ?? null,
            'hd'            => $hd['url'] ?? null,
        ]);
    }
}
