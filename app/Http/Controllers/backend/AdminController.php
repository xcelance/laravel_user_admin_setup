<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use User;

class AdminController extends Controller
{
    /**
     * admin dashboard controller.
     *
     * @return void
    */
    public function index() {
    	return view('backend.dashboard.index');
    }
}
