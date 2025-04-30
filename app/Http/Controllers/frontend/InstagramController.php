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

    public function views(Request $request)
    {
        $tools = tools::where('slug', '/instagram-video-downloader')->first();
        $tools->view = $tools->view + 1;
        $tools->save(); 

        return response()->json([
            'views' => $tools->view
        ]);
    }
  
}
