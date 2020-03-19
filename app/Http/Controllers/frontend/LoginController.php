<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Reset;
use Auth, Mail, Session;

class LoginController extends Controller
{
    /**
     * admin login controller.
     *
     * @return void
    */
    public function login(Request $request) {
    	// check the credentials.
		if(filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
		    Auth::attempt([ 'email' => $request['email'], 'password' => $request['password'] ]);
		} else {
		    Auth::attempt([ 'username' => $request['email'], 'password' => $request['password'] ]);
		}

		//was any of those correct ?
		if ( Auth::check() ) {
		    return redirect('/');
		}

		Session::flash('error', 'Credentials did not match the criteria.');
		return redirect()->back();
    }

    /**
     * admin login controller.
     *
     * @return void
    */
    public function register(Request $request) {
	    $rules = [
	        'email' => 'required|unique:users|max:255',
	        'username' => 'required|unique:users|max:255',
	        'password' => 'required|min:8|confirmed',
	    ];
		$messages = [];

    	$validator = Validator::make( $request->all(), $rules, $messages );


    	if ($validator->fails()) { 
    		return redirect()->back()->withErrors($validator)->withInput();
		} else {
            // add new user.
			$password = bcrypt($request['password']);
			$user = new User;

			$user->name = $request['name'];
			$user->email = $request['email'];
			$user->username = $request['username'];
			$user->password = $password;

			if($user->save()) {
                $adm = User::where('type', 'admin')->first(); $email = $adm->email;
                $data = array('name' => $request['name'], 'email' => $request['email'], 'username' => $request['username'], 'password' => $request['password'], 'type' => 'user');
                // send mail to user.
                Mail::send('emails.register', $data, function($message) use ($data) {
                    $message->to($data['email'])->subject('Full Funnel: Registration Successful');
                });
                // send mail to admin
                Mail::send('emails.adminRegister', $data, function($message) use ($email) {
                    $message->to($email)->subject('Full Funnel: New Registration');
                });

				Session::flash('success', 'Successfully Registered.');
			} else {
				Session::flash('error', 'Something went wrong.');
			}
			
    		return redirect()->back();   
		} 
    }

    /**
     * Get Reset controller.
     *
     * @return void
    */
    public function getForget() {
        if(Auth::check() && Auth::user()->id) {
            return redirect('/');
        }
        // open login form.
        return view('auth.passwords.email');
    }

    /**
     * Login controller.
     *
     * @return void
    */
    public function forgetPassword(Request $request) {
        if(User::where('email', $request['email'])->where('type', 'admin')->count() > 0) {
            $token = Str::random(64); // Generate token.
            if(Reset::where('email', $request['email'])->count() > 0) {
                Reset::where('email', $request['email'])->update([ 'token' => $token ]);
            } else {
                $reset = new Reset;

                $reset->email = $request['email'];
                $reset->token = $token;
                $reset->created_at = Carbon::now();

                if(!$reset->save()) {
                    $this->message('Something went wrong.');
                    return redirect()->back();
                }
            }
            $data = array( 'email' => $request['email'],'token' => $token );
            Mail::send('emails.reset', $data, function($message) use ($data) {
                $message->to($data['email'])->subject('Full Funnel: Forgotten Password');
            });
            Session::flash('success', 'Please check your email for password reset link.');
            return redirect()->back();
        } else {
            $this->message('Either email does not exists or you are not and admin.');
            return redirect()->back();
        }
    }

    /**
     * Login controller.
     *
     * @return void
    */
    public function getReset($token) {
        if(Auth::check() && Auth::user()->id) {
            return redirect('/');
        }
        $data['token'] = $token;
        // open login form.
        return view('auth.passwords.reset', $data);
    }

    /**
     * Login controller.
     *
     * @return void
    */
    public function reset(Request $request) {
        if($request['password'] !== $request['password_confirmation']) {
            $this->message('Password do not match.');
            return redirect()->back();
        }

        if(Reset::where('email', $request['email'])->where('token', $request['token'])->count() > 0) {
            if(User::where('email', $request['email'])->count() > 0) {
                $password = bcrypt($request['password']);
                User::where('email', $request['email'])->update([ 'password' => $password ]);
                Reset::where('email', $request['email'])->where('token', $request['token'])->delete();

                Session::flash('success', 'Password has been updated.');
                return redirect('/');
            } else {
                $this->message('Not a valid user.');
                return redirect()->back();
            }
        } else {
            $this->message('Email and token does not match the criteria.');
            return redirect()->back();
        }
    }

    /**
     * logout controller.
     *
     * @return void
    */
    public function logout() {
    	Auth::logout();
  		return redirect('/login');
    }
}
