<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller{
    
    public function login(Request $request){
    	$user = new User();
    	$username = $request->username;
    	$password = $request->password;

    	$messages = [
    		'username.required' => 'Morate uneti korisničko ime',
    		'password.required' => 'Morate uneti lozinku'
    	];

    	$request->validate([
    		'username' => 'required',
    		'password' => 'required'
    	], $messages);

    	try{
    		$auth = $user->login($username, $password);
    		if(!empty($auth)){
    			$request->session()->put('username', $auth->username);
    			$request->session()->put('email', $auth->email);
                $request->session()->put('role', $auth->name);
    			return redirect('/');
    		}
    		else{
    			return back()->with('error', 'Korisničko ime ili lozinka su neispravni');
    		}
    	}catch(\Exception $e){
            \Log::error('Neuspešna prijava. '.$e);
            return back()->with('errors', 'Neuspešna prijava.');
        }
    }

    public function logout(Request $request){
    	$request->session()->flush();
    	return redirect('/');
    }

}
