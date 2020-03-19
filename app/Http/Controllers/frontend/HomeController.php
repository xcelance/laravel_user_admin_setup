<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
     * index controller.
     *
     * @return void
    */
    public function index() {
    	return view('index');
    }

    /**
     * test controller.
     *
     * @return void
    */
    public function test() {
    	return view('test');
    }
}
