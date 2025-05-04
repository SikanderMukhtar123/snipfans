<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class YoutubeVideoController extends Controller
{
    public function index()
    {
        return view('frontend.downloader.yt.index');
    }

    public function video(Request $req)
    {
        // $url = $req->input('url');
        
        $url =  'https://www.youtube.com/watch?v=9bZp1g2v4xk';
        // Initialize Guzzle client to make a request to Instagram API or video scraping endpoint
        $client = new Client();
        $response = $client->post('https://www.clipto.com/api/youtube', [
            'form_params' => [
                'url' => $url,
            ]
        ]);
        
        $rawBody = (string)$response->getBody();
        dd($rawBody); // See the actual content returned by the API
        
        $data = json_decode($rawBody, true);
        
    
        if (isset($data['data'])) {
            return response()->json(['success' => true, 'data' => $data['data']]);
        }
    
        return response()->json(['success' => false]);
    }
}
