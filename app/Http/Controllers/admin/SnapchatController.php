<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\DomCrawler\Crawler;

class SnapchatController extends Controller
{
    public function index()
    {
        return view('frontend.downloader.snap.index');
    }

    public function video(Request $request)
    {
         $url = $request->url;
        // Initialize Guzzle client
        $client = new Client();

        // Prepare the data for the POST request
        $postData = [
            'form_params' => [
                'url' => $url, // The Snapchat URL to download
                'format' => '', // If you need to specify a format, add here
            ],
            'headers' => [
                'Authorization' => 'Bearer 43010920b2b55be620a0e31ac052407c4f667264d3610b4559856139bb1c72fc', // Token for authentication
                'Accept' => 'application/json', // Accept JSON response
                'Content-Type' => 'application/x-www-form-urlencoded', // Content type
            ]
        ];

        try {
            // Send POST request to the download API
            $response = $client->request('POST', 'https://www.whitehattoolbox.com/videodownloader/wp-json/aio-dl/video-data/', $postData);

            // Get the response body (in this case, it might contain download links or status)
            $responseBody = $response->getBody()->getContents();

            // Optionally, you can decode the JSON response if it's in JSON format
            $data = json_decode($responseBody, true);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            // Handle error (e.g., failed request, invalid response, etc.)
            dd('Error: ' . $e->getMessage());
        }
    }
}
