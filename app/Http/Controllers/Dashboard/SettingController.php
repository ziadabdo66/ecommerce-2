<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\models\Setting;
use Illuminate\Http\Request;
use DB;

class SettingController extends Controller
{

    public function editShippingMethods($type){
if($type==='free'){
    $shippingMethod= Setting::where('key','free_shipping_label')->first();
}
else if($type==='inner'){
    return Setting::where('key','local_label')->first();
}
else if($type==='external'){
    $shippingMethod= Setting::where('key','Outer_label')->first();
}
else{
    $shippingMethod= Setting::where('key','free_shipping_label')->first();
}
        return view('dashboard.settings.shippings.edit',compact('shippingMethod'));

    }


    public function updateShippingMethods(ShippingRequest $request,$updateSettingId){
        try{
            DB::beginTransaction();

       $shipping_method= Setting::find($updateSettingId);
       $shipping_method->update(['plan_value'=>$request->plan_value]);
       $shipping_method->value=$request->value;
       $shipping_method->save();
       DB::commit();
        return redirect()->back()->with(['success' => 'تم التعديل بنجاح']);
        }
       catch (Exception $ex) {
        DB::rollback();
           return redirect()->back()->with(['error' => 'هناك خطأ اعد المحاوله']);
       }

    }
}
