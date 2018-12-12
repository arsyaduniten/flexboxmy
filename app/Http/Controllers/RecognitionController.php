<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecognitionController extends Controller
{
    //
    public function index(Request $request)
    {
    	$source = $request['source'];
    	$target = $request['target'];
    	$source_data = file_get_contents($source->getRealPath());
    	$target_data = file_get_contents($target->getRealPath());
    	// dd($request['source']->getClientOriginalName());
    	$client = new \GuzzleHttp\Client();
    	$response = $client->request('POST', 'https://4b2rof2e41.execute-api.ap-southeast-1.amazonaws.com/default/facialRekog', [
    		'debug' => true,
    		'headers' => [
    			'x-api-key' => 'kuFDBWIIaQ3TKxYYoeNp71pmA1p1P0hA3f5Q6Mgp',
    			'Content-Type' => 'multipart/form-data'
    		],
	        'multipart' => [
	        	[
	        		'name'=> 'source',
	        		'contents'=> $source_data
	        	],
	        	[
	        		'name'=> 'target',
	        		'contents'=> $target_data
	        	]
	    	]
	    ]);
	    dd($response);
	    $response = $response->getBody();
    }
}
