<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\models\Attribute;
use App\models\Brand;
use Illuminate\Http\Request;
use DB;

class attributeController extends Controller
{
    public function index(){
        $attributes=Attribute::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.attributes.index',compact('attributes'));
    }
    public function create(){
        return view('dashboard.attributes.create');
    }
    public function store(AttributeRequest $request){
        try {

            DB::beginTransaction();

            $attribute = Attribute::create([]);
            $attribute->name = $request->name;
            $attribute->save();
            return redirect()->route('admin.attribute')->with(['success' => 'تم الاضافه بنجاح']);
            DB::commit();

        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.attribute')->with(['error' => 'لم يتم الاضافه']);

        }
    }
    public function edit($attribute_id){
        $attribute=Attribute::find($attribute_id);
        return view('dashboard.attributes.edit',compact('attribute'));
    }
    public function update(AttributeRequest $request,$attribute_id)
    {
        try {


        DB::beginTransaction();
        $attribute = Attribute::find($attribute_id);
        if (!$attribute) {
             return redirect()->route('admin.attribute')->with(['error' => 'هذه الخاصيه غير موجوده']);
}

        $attribute->name = $request->name;
        $attribute->save();
        return redirect()->route('admin.attribute')->with(['success' => 'تم التعديل بنجاح']);
        DB::commit();

    } catch (Exception $ex) {
DB::rollback();
return redirect()->route('admin.attribute')->with(['error' => 'لم يتم التعديل']);

}}
public function delete($attribute_id){
    try {
        DB::beginTransaction();

        $attribute = Attribute::find($attribute_id);
        if (!$attribute) {
            return redirect()->route('admin.attribute')->with(['error' => 'هذه الخاصيه غير موجوده']);
        }
        $attribute->attribute_translation()->delete();
        $attribute->delete();
        return redirect()->route('admin.attribute')->with(['success' => 'تم الحذف بنجاح']);
        DB::commit();
    }catch (\Exception $ex){
        DB::rollback();
        return redirect()->route('admin.attribute')->with(['error' => 'لم يتم الحذف']);
    }

}


}
