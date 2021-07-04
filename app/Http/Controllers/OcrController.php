<?php

namespace App\Http\Controllers;

use App\User;
use App\users_details;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class AiocrController extends Controller
{
    public function index()
    {
    	// return "OK";
    	// return Auth::User()->id;
    	if(Auth::User()){
	        $title = "Dashboard";
	        $active = 'dashboard';
	        return view('frontend.pages.aiocr',compact('title','active'));
		}else{
			return redirect('/login');
		}
    }
}
