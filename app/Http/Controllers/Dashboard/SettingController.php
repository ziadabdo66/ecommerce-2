<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\models\Setting;
use Illuminate\Http\Request;

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


    public function updateShippingMethods(Request $request,$updateSettingId){

    }
}
