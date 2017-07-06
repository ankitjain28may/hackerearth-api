<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HackerEarth;

class TestController extends Controller
{
    public function index(Request $request) {

    	return HackerEarth::compilefile("PHP", realpath($request->file('file')) , "dg dg ");
    	/*return HackerEarth::compile("PHP", "<?php echo 'helloworld!'; ?>", ["dg"]);
    */}
}

