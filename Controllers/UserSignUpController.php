<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSignUpController extends Controller
{
    public function index()
    {
    	$users = User::get();

    	return view('user_sign_up.index', compact('users'));
    }

    public function create($id)
    {
    	$user = User::find($id);
    	if ($user->user_type_id == 1) {
    		return view('user_sign_up.usa_user', compact('user'));
    	} else if ($user->user_type_id == 2) {
    		return view('user_sign_up.supplier', compact('user'));
    	} else {
    		return view('user_sign_up.customer', compact('user'));
    	}

    	//return view('user_sign_up.usa_user');
    }

    public function signUpUsaUser(Request $request)
    {
    	
    	$user = User::find($request->id);
    	$user->update([
    			'password' => Hash::make($request->password),
    		]);
    	//return "updated";
    	die(json_encode(['status'=>200,'reason'=>'success','user'=>$user]));
    }
}
