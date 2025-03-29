<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\tools;
use Illuminate\Http\Request;

class TitktokController extends Controller
{
    public function index()
    {
        return view('frontend.downloader.tiktok.index');
    }

    public function request(Request $request)
    {
        $url = $request->url;

        // Check if the URL is a shortened URL (e.g., vt.tiktok.com or tiktok.com/t/)
        if (preg_match('/vt\.tiktok\.com\//', $url) || preg_match('/tiktok\.com\/t\//', $url)) {
            $url = $this->expandShortUrl($url);
        }

        // Extract video ID from the expanded URL (e.g., https://www.tiktok.com/@username/video/1234567890123456789)
        preg_match('/video\/(\d+)/', $url, $matches);
        if (!isset($matches[1])) {
            return redirect()->back()->with('error', 'Invalid TikTok URL');
        }

        $videoId = $matches[1];
        $apiUrl = "https://www.tikwm.com/api/?url=https://www.tiktok.com/@username/video/$videoId";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (isset($data['data']['play'])) {
            return response()->json([
                'no_watermark' => $data['data']['play'],
                'watermark' => $data['data']['wmplay'],
                'hd' => $data['data']['hdplay'] ?? null
            ]);
        }

        return redirect()->back()->with('error', 'Failed to fetch video');
    }

    /**
     * Expand a shortened TikTok URL by following the Location header.
     *
     * @param string $shortUrl
     * @return string
     */
    private function expandShortUrl($shortUrl)
    {
        $headers = @get_headers($shortUrl, 1);
        if ($headers && isset($headers['Location'])) {
            return is_array($headers['Location']) ? end($headers['Location']) : $headers['Location'];
        }
        return $shortUrl; // Fallback if no redirection is found
    }

    public function views(Request $request)
    {

        $tools = tools::where('slug', '/tiktok-video-downloader')->first();
        $tools->view = $tools->view + 1;
        $tools->save();

        return response()->json([
            'views' => $tools->view
        ]);
    }
}
