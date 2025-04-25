<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use voku\helper\HtmlDomParser;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class InstagramController extends Controller
{
    public function index()
    {
        return view('frontend.downloader.inst.index');
    }


    public function testConnection()
    {
        $client = new Client();

        try {
            // Test a basic GET request to an external URL
            $response = $client->get('https://www.google.com');
            return response()->json(['message' => 'Connection successful.']);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return response()->json(['error' => 'Failed to connect: ' . $e->getMessage()], 500);
        }
    }

    public function video(Request $req)
    {
        $url = $req->input('url');
        
        // Initialize Guzzle client to make a request to Instagram API or video scraping endpoint
        $client = new Client();
        $response = $client->post('https://savegram.app/api/ajaxSearch', [
            'form_params' => [
                'k_exp' => '1745364077',
                'k_token' => 'd4aded06273508ec757d7df9f96b557d657a51c47093de3661c535246f150500',
                'q' => $url,
                't' => 'media',
                'lang' => 'en',
                'v' => 'v2'
            ]
        ]);
    
        // Assuming the API returns the video URL for downloading
        $data = json_decode($response->getBody(), true);
    
    
        if (isset($data['data'])) {
            return response()->json(['success' => true, 'data' => $data['data']]);
        }
    
        return response()->json(['success' => false]);
    }



    // public function Video(Request $req)
    // {
    //     $reelUrl = $req->input('url');

    //     if (!$reelUrl) {
    //         return response()->json(['error' => 'Reel URL is required'], 400);
    //     }

    //     $response = Http::withHeaders([
    //         'x-rapidapi-host' => 'instagram-social-api.p.rapidapi.com',
    //         'x-rapidapi-key' => 'd175f87ac7msh9ad456be4af15b1p10b496jsn45e43437f091',
    //     ])->get('https://instagram-social-api.p.rapidapi.com/v1/reels', [
    //         'username_or_id_or_url' => 'https://www.instagram.com/reel/DFXsaZKvAwK',
    //     ]);

    //     $data = $response->json();
        
    //     if (!isset($data['data']['items'][0]['video_url'])) {
    //         return response()->json(['error' => 'Unable to fetch reel data.'], 500);
    //     }

    //     $reel = $data['data']['items'][0];
    //     // view_count

    //     return response()->json([
    //         'title' => $reel['caption'] ?? 'Instagram Reel', // caption is null in your response
    //         'video_url' => $reel['video_url'] ?? null, // this exists and is present
    //         'author' => $reel['user']['username'] ?? 'Unknown', // "reel" is the username
    //         'published_at' => $reel['taken_at_date'] ?? null, // formatted ISO timestamp exists
    //         'likes' => $reel['like_count'] ?? 0, // 23
    //         'comments' => $reel['comment_count'] ?? 0, // 2
    //     ]);
    // }
    
}
