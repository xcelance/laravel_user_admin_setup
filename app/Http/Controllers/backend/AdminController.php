<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Session, Mail;

class AdminController extends Controller
{
    /**
     * admin dashboard controller.
     *
     * @return void
    */
    public function index() {
        $data['admin_ct'] = User::where('type', 'admin')->count();
        $data['user_ct'] = User::where('type', 'user')->count();

    	return view('backend.dashboard.index', $data);
    }

    /**
     * List all users from table.
     *
     * @return void
    */
    public function listUsers() {
    	$data['users'] = User::all();
    	return view('backend.users.index', $data);
    }

    /**
     * add new user.
     *
     * @return void
    */
    public function getUser() {
    	return view('backend.users.add');
    }

    /**
     * add new user.
     *
     * @return void
    */
    public function addUser(Request $request) {
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
			$password = bcrypt($request['password']);
			$user = new User;

			$user->name = $request['name'];
			$user->email = $request['email'];
			$user->username = $request['username'];
            $user->type = $request['type'];
			$user->password = $password;

			if($user->save()) {
                $adm = User::where('type', 'admin')->first(); $email = $adm->email;
                $data = array('name' => $request['name'], 'email' => $request['email'], 'username' => $request['username'], 'password' => $request['password'], 'type' => $request['type']);
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
     * List all users from table.
     *
     * @return void
    */
    public function editUser($_id) {
    	$id = base64_decode($_id);
    	$data['user'] = User::where('id', $id)->first();

    	return view('backend.users.edit', $data);
    }

    /**
     * List all users from table.
     *
     * @return void
    */
    public function updateUser(Request $request) {

    	if(User::where('email', $request['email'])->where('id', '!=', $request['id'])->count() > 0) {
    		Session::flash('error', 'Email Already Exists.');
    		return redirect()->back();
    	} else if(User::where('username', $request['username'])->where('id', '!=', $request['id'])->count() > 0) {
    		Session::flash('error', 'Username Already Exists.');
    		return redirect()->back();
    	} else {
	    	if($request['profile']) {
	    		$file = $request->file('profile');
	    		$image = User::uploadProfile($file);
	    		User::where('id', $request['id'])->update([ 'profile' => $image ]);
	    	}
	    	
	    	User::where('id', $request['id'])->update([ 'name' => $request['name'], 'email' => $request['email'], 'username' => $request['username'], 'type' => $request['type'] ]);

	    	Session::flash('success', 'User Updated Successfully.');
    		return redirect()->back();
	    }
    }

    /**
     * delete user.
     *
     * @return void
    */
    public function deleteUser($_id) {
        $id = base64_decode($_id);
        User::where('id', $id)->delete();

        Session::flash('success', 'User Deleted Successfully.');
        return redirect()->back();
    }
}
