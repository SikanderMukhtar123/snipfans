<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YoutubeVideoDownloader extends Controller
{
    public function index()
    {
        return view('frontend.downloader.youtube.index');
    }

    public function youtubeRequest(Request $request)
    {
        $request->validate([
            'url' => 'required|url|starts_with:https://www.youtube.com',
        ]);

        $videoUrl = $request->input('url');
        $response = $this->getYouTubeVideoDetails($videoUrl);

        if (!$response) {
            return response()->json(['error' => 'Failed to fetch video.'], 400);
        }

        return response()->json($response);
    }

    public function views(Request $request)
    {
        // Track views (you can store this data in a database or log file)
        return response()->json(['message' => 'View recorded']);
    }

    private function getYouTubeVideoDetails($url)
    {
        // Use yt-dlp or youtube-dl to fetch the video details
        try {
            // Run yt-dlp command to get video details in JSON format
            $process = new Process(['yt-dlp', '-j', $url]); // JSON output
            $process->run();

            // Check if the process was successful
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $videoData = json_decode($process->getOutput(), true);

            // Extract required video details
            $videoTitle = $videoData['title'] ?? 'Unknown Title';
            $channelName = $videoData['uploader'] ?? 'Unknown Channel';
            $likes = $videoData['like_count'] ?? 0;
            $comments = $videoData['comment_count'] ?? 0;
            $formats = $videoData['formats'] ?? [];

            // Video URLs for various qualities (HD, audio, etc.)
            $hdUrl = null;
            $noWatermarkUrl = null;
            $audioUrl = null;

            // Search for formats and get URLs for HD and high-quality video
            foreach ($formats as $format) {
                if (isset($format['height']) && $format['height'] >= 720) {
                    if (!$hdUrl) {
                        $hdUrl = $format['url']; // HD quality
                    }
                }
                if ($format['format_note'] !== 'audio only') {
                    $noWatermarkUrl = $format['url']; // Best quality video URL
                }
                if (isset($format['acodec']) && $format['acodec'] !== 'none') {
                    $audioUrl = $format['url']; // Audio URL (if available)
                }
            }

            return [
                'title' => $videoTitle,
                'channel_name' => $channelName,
                'likes' => $likes,
                'comments' => $comments,
                'no_watermark' => $noWatermarkUrl,
                'hd' => $hdUrl,
                'audio' => $audioUrl
            ];

        } catch (\Exception $e) {
            return null;  // Return null if any error occurs while fetching details
        }
    }
}
