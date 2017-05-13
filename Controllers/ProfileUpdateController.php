<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SystemSettings;
use App\Models\Role;
use App\Models\UserProfile;
use App\Models\Country;
use App\Models\ShippingPort;
use App\User;

class ProfileUpdateController extends Controller
{
    public function index() 
    {
    	$user = Auth::user();
    	$roleId = $user->role_id;
    	$userId = $user->id;

    	if ($roleId == 2) {
    		$data['user'] = Auth::user();
    		$data['roles'] = Role::get();
    		$data['countries'] = Country::orderBy('name')->get();
    		$data['shippingPorts'] = ShippingPort::get();
    		$data['roleOfUser'] = User::with('role', 'userProfile')->where('id', $userId)->where('role_id', $roleId)->first();
    		$phones = $data['roleOfUser']->userProfile->phone;
    		$data['phoneArray'] = explode(",",$phones);
    		$jsonEnData = $data['roleOfUser']->userProfile->point_of_contacts;
    		$userProfile = UserProfile::where('user_id', $userId)->first();
    		//return "testr";
    		//return $j = $userProfile->point_of_contacts;

    		$data['jsonDeData'] = json_decode($jsonEnData);
    		
    		$data['permitted_features'] = SystemSettings::checkPermission($user->id,$user->role_id);
    		return view('profile_update.supplier_profile', $data);
    	} else {
    		$data['user'] = Auth::user();
    		$data['roles'] = Role::get();
    		$data['roleOfUser'] = User::with('role', 'userProfile')->where('id', $userId)->where('role_id', $roleId)->first();
    		$data['permitted_features'] = SystemSettings::checkPermission($user->id,$user->role_id);
    		return view('profile_update.usa_user_profile', $data);
    	}
    }

    public function updateUsaUserProfile(Request $request)
    {
    	//return $request->all();
    	$userProfile = UserProfile::where('user_id', $request->user_id)->first();
    	$userProfile->name = $request->name;

		$userProfile->save();

		die(json_encode(['status'=>200,'reason'=>'success','userProfile'=>$userProfile]));
    }

    public function updateSupplierProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'shipping_portal_email' => 'required|email',
            'export_country_id' => 'required',
            'shipping_port_id' => 'required',
            'email' => 'required|email|string',
        ]);

        $arrMainContact = [];
        $point_of_contacts = $request->point_of_contacts;
        $var2 = $request->role;
        $var3 = $request->contact_email;
        foreach ($point_of_contacts as $key => $value) {
           if (( $point_of_contacts[$key] != "") || ($var2[$key] != "") || ($var3[$key] != "") ) {
               $arrPointOfContact = [
                                'point_of_contract' => $point_of_contacts[$key], 
                                'role' => $var2[$key], 
                                'email' => $var3[$key],
                                ];
        array_push($arrMainContact, $arrPointOfContact);
           }
        }
        
        $jsonEncodeContacts = json_encode($arrMainContact);

        
        $phone = implode(',',array_filter($request->phone));
        //return $request->all();
        $userProfile = UserProfile::find($request->user_profile_id);
        
        $userProfile->name = $request->name;
        $userProfile->address = $request->address;
        $userProfile->shipping_portal_email = $request->shipping_portal_email;
        $userProfile->export_country_id = $request->export_country_id;
        $userProfile->shipping_port_id = $request->shipping_port_id;
        $userProfile->phone = $phone;
        $userProfile->point_of_contacts = $jsonEncodeContacts;

        $userProfile->save();

        die(json_encode(['status'=>200,'reason'=>'success','userProfile'=>$userProfile]));
    }
}
