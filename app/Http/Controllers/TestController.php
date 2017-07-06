<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ankitjain28may\HackerEarth\HackerEarth;

class TestController extends Controller
{
    public function index(Request $request) {

    	// return HackerEarth::compilefile("PHP", realpath($request->file('file')) , "dg dg ");

    	$ob = new HackerEarth(['api_key' => env('HACKEREARTH_SECRET_KEY', 'CLIENT_SECRET_KEY')]);

    	return  $ob->Compile("PHP", "<?php echo 'helloworld!'; ?>", ["dg"]);
    }
}

