<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HackerEarth;

class TestController extends Controller
{
    public function index() {

    	return HackerEarth::index(["api_key"     => 'hackerrank_app_key']);

    	$ob = new HackerEarth(["api_key"     => 'hackerrank_app_key']);
    	return $ob->index();
    }
}
