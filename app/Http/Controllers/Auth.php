<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class Auth extends Controller
{

    public function dashboard(){
        return view('frontend.index');
        }

    public function signupPage(){
    return view('frontend.register');
    }

   public function signup(Request $request){
    $this->validate($request, [
        'first_name' => 'required|min:3',
        'last_name' => 'required|min:3',
        'email' => 'required|unique:users',
        'password' => 'required|confirmed'
    ]);

    Sentinel::registerAndActivate($request->all());
    return redirect('/')->with('success', 'account created successfully, please login');
   }


   public function signin(Request $request){
    Sentinel::Authenticate($request->all());

    if(Sentinel::check()){
        return redirect('/admin/dashboard');
    }else{
       return back()->with('error', 'incorrect login credentials');
    }
}

public function logout(){
    Sentinel::logout();
 
    return redirect('/');
 }


}
