<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\models\Brand;
use App\models\Category;
use Illuminate\Http\Request;
use DB;

class BrandController extends Controller
{
    public function index(){

        $brands=Brand::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.brands.index',compact('brands'));
    }
    public function create(){
        return view('dashboard.brands.create');
    }
    public function store(BrandRequest $request){

        try {

            DB::beginTransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }
            $filename="";
            if($request->has('photo')){
                $filename=uploadimage('brands',$request->photo);
            }
            $brand = Brand::create($request->except('_token','photo'));
            $brand->name = $request->name;
            $brand->photo=$filename;
            $brand->save();
            return redirect()->route('admin.brand')->with(['success' => 'تم الاضافه بنجاح']);
            DB::commit();

        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.brand')->with(['error' => 'لم يتم الاضافه']);

        }

    }
    public function edit($id){
        $brand=Brand::orderBy('id','DESC')->find($id);
        if(!$brand)
            return route('admin.brand')->with(['error'=>'هذه الماركه غير موجوده']);
        return view('dashboard.brands.edit',compact('brand'));
    }
    public  function update(BrandRequest $request,$id){
        try {
            DB::beginTransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }

            $brand = Brand::find($id);
            if (!$brand)
                return redirect()->route('admin.brand')->with(['error' => 'هناك خطا ما حاول لاحقا']);

            $filename="";
            if($request->has('photo')) {
                $filename = uploadimage('brands', $request->photo);
                Brand::where('id', $id)->update(['photo' => $filename]);
            }

            $brand->update($request->except('_token','photo','id'));
            $brand->name = $request->name;
            $brand->save();
            return redirect()->route('admin.brand')->with(['success' => 'تم التحديث بنجاح']);
            DB::commit();
        }
        catch (\Exception $ex ){
            DB::rollback();
            return redirect()->route('admin.brand')->with(['error' => 'هناك خطا ما حاول لاحقا']);
        }
    }
    public function delete($id){
        try {
            $brand = Brand::find($id);
            if (!$brand)
                return redirect()->route('admin.brand')->with(['error' => 'هذه الماركه غير موجوده']);




            $brand->delete();
            return redirect()->route('admin.brand')->with(['success' => 'تم الحذف بنجاح']);
        }
        catch (\Exception $ex){
            return redirect()->route('admin.brand')->with(['error' => 'هناك خطا ما حاول لاحقا']);
        }
    }
}
