<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, Session;

class LoginController extends Controller
{
    /**
     * admin login get.
     *
     * @return void
    */
    public function index() {
    	if(Auth::check() && Auth::user()->id) {
            return redirect('/admin');
        }

    	return view('backend.auth.login');
    }

    /**
     * admin login controller.
     *
     * @return void
    */
    public function login(Request $request) {
    	// check the credentials.
		if(filter_var($request['username'], FILTER_VALIDATE_EMAIL)) {
		    Auth::attempt([ 'email' => $request['username'], 'password' => $request['password'], 'type' => 'admin' ]);
		} else {
		    Auth::attempt([ 'username' => $request['username'], 'password' => $request['password'], 'type' => 'admin' ]);
		}

		//was any of those correct ?
		if ( Auth::check() ) {
		    return redirect('/admin');
		}

		Session::flash('error', 'Credentials did not match the criteria.');
		return redirect()->back();
    }

    /**
     * logout controller.
     *
     * @return void
    */
    public function logout() {
    	Auth::logout();
  		return redirect('/admin/login');
    }
}
