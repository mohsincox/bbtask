<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewRequestRequest;
use App\Models\UserType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewRequestController extends Controller
{
    public function index()
    {
        $userTypeList = UserType::get();
        return view('new_request.index', compact('userTypeList'));
    }
    
    public function storeData(NewRequestRequest $request)
    {
        //return $request->all();
        $lastRow = User::orderBy('id', 'desc')->first();
        $userId = $lastRow->id + 1;
        $email = $request->email;
        //$token =  str_random(30);
        $token =  $userId.'|'.$request->email.'|'.$request->user_type_id;
        $message = "http://satsai.com/hedayafashion/sign-up/$token";
        
        $headers =  'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From: Your name <info@address.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        
        
        // if (mail($email, 'Token', $message, $headers)) {
        $user = User::create([
                                 'email' => $request->email,
                                 'sign_up_request_token' => $token,
                                 'status' => 4,
                                 'sign_up_request_sent_by' => Auth::id(),
                                 'user_type_id' => $request->user_type_id,
                             ]);
        // $user->update([
        //         'sign_up_request_token' => $user->id.'|'.$user->email.'|'.$user->user_type_id
        //     ]);
        $token = $user->sign_up_request_token;
        //return 'successfully send';
        flash()->message('successfully sent');
        //return redirect()->back();
        die(json_encode(['status'=>200,'reason'=>'success','user'=>$user]));
        //return redirect('/satsai.com/hedayafashion/sign-up/'.$token);
        // } else {
        // 	return 'Something Wrong!';
        // }
        
    }
}
