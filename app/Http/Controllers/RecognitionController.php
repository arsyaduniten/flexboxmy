<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ImageOptimizer;

class RecognitionController extends Controller
{
    //
    public function index(Request $request)
    {
    	// $source = $request['source'];
    	// $target = $request['target'];
        $source = $request->file('source');
        $target = $request->file('target');
        ImageOptimizer::optimize($source->getRealPath());
        ImageOptimizer::optimize($target->getRealPath());
        // dd(file_get_contents($source->getRealPath()));
    	$source_data = base64_encode(file_get_contents($source->getRealPath()));
        // dd($source_data);
    	$target_data = base64_encode(file_get_contents($target->getRealPath()));
        // dd($source_data);
    	// dd($request['source']->getClientOriginalName());
    	$client = new \GuzzleHttp\Client();
        $payload = [
            'source'=> $source_data,
            'target'=> $target_data
        ];
        $payload = json_encode($payload);
    	$response = $client->request('POST', 'https://4b2rof2e41.execute-api.ap-southeast-1.amazonaws.com/default/facialRekog', [
    		'headers' => [
    			'x-api-key' => 'kuFDBWIIaQ3TKxYYoeNp71pmA1p1P0hA3f5Q6Mgp',
    			'Content-Type' => 'application/json'
    		],
	        'body' => $payload
	    ]);
	    $result = json_decode($response->getBody());
        // dd($result);
        return response()->json($result);
    }

    public function test()
    {
        return "PONG";
    }
}
