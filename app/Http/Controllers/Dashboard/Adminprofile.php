<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\models\Admin;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;


class Adminprofile extends Controller
{
    public function edit(){
        $admin=Admin::find(auth('admin')->user());

        return view('dashboard.auth.editprofile',compact('admin'));
    }


    public function update(\App\Http\Requests\Adminprofile $request,$id ){
      // return $request->all();

        try {


           $admin = Admin::find(auth('admin')->user()->id);
       //  return $request->filled('password');
            if ($request->filled('password')) {
                $request->merge(['password' => bcrypt($request->password)]);
            }
            unset($request->id);
            unset($request->confirm_password);
            $admin->update($request->all());
            return redirect()->back()->with(['success' => 'تم التعديل بنجاح']);
        }
        catch (Exception $ex){
            return redirect()->back()->with(['error' => 'هناك حطا حاول مره اخري']);
        }


    }

}
