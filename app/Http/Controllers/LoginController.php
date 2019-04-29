<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller {
    
    public function index() {
        return view('auth.login');
    }
    
    public function authenticate(Request $request) {
        $login = htmlspecialchars($request->login);
        $password = htmlspecialchars($request->password);

        if($login=='' || $password=='') {
            return redirect()->back()->with('update_error', "Enter both credentials");
        }
        //checking whether user is logging in with username or email
        $field = (filter_var($login, FILTER_VALIDATE_EMAIL)) ? 'email' : 'username';

        //autherize function
        if (Auth::attempt([$field => $login, 'password' => $password])) {//auth success
            if(Auth::user()->status!=1) {//check if the user is blocked or not
                Auth::logout();
                return redirect('/')->with('update_error', "You are blocked by the admin. Kindly contact the support");
            }
            //user autherized, redirect to respective routes
            $redirectTo = get_account_route();
            return redirect($redirectTo)->with('update_success', 'Welcome back, '.ucwords(Auth::user()->name));
        }else {
            return redirect()->back()->with('update_error', "Credentials doesn't match");
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/')->with('update_success', "Logged out Successfully");
    }
}