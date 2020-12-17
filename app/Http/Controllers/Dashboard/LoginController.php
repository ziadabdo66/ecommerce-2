<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adminloginrequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('dashboard.auth.login');
    }
    public function postlogin(Adminloginrequest $request ){
        $remember_me=$request->has('remember') ? true : false;
        if(auth()->guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
            return redirect()->route('admin_dashboard');
        }
        return redirect()->back()->with(['error'=>'هناك خطا في ادخال البيانات']);

    }
}
