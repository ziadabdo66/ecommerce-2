<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\mainCategoryRequest;
use App\Http\Requests\mainsCategoryRequest;
use App\Http\Requests\subCategoryRequest;
use App\models\Category;
use App\models\Setting;
use Illuminate\Http\Request;
use DB;

class MainCategoriesController extends Controller
{
    public function index($type){

        if($type==='main'){

 $categories=Category::Parent()->paginate(PAGINATION_COUNT);
 return view('dashboard.categories.index',compact('categories','type'));
        }
        elseif ($type==='sub'){
            $categories=Category::Child()->paginate(PAGINATION_COUNT);
            return view('dashboard.categories.index',compact('categories','type'));
        }


    }
    public function create($type){
        if($type==='main') {
            return view('dashboard.categories.create');
        }
        elseif ($type==='sub'){
            $categories=Category::Parent()->orderBy('id','DESC')->get();
            return view('dashboard.categories.createsubcategory',compact('categories'));
        }
    }
##############################store######################

    public function store(mainCategoryRequest $request){
 $type=$request->type;
 if($type==='main'){
            try {

                DB::beginTransaction();
                if (!$request->has('is_active')) {
                    $request->request->add(['is_active' => 0]);
                } else {
                    $request->request->add(['is_active' => 1]);
                }
                $category = Category::create($request->except('_token'));
                $category->name = $request->name;
                $category->save();
                return redirect()->route('admin.mainCategories',$type)->with(['success' => 'تم الاضافه بنجاح']);
                DB::commit();

            } catch (Exception $ex) {
                DB::rollback();
                return redirect()->route('admin.mainCategories',$type)->with(['error' => 'لم يتم الاضافه']);

            }
 }
        if($type==='sub'){
            try {

                DB::beginTransaction();
                if (!$request->has('is_active')) {
                    $request->request->add(['is_active' => 0]);
                } else {
                    $request->request->add(['is_active' => 1]);
                }
                $category = Category::create($request->except('_token'));
                $category->name = $request->name;
                $category->save();
                return redirect()->route('admin.mainCategories',$type)->with(['success' => 'تم الاضافه بنجاح']);
                DB::commit();

            } catch (Exception $ex) {
                DB::rollback();
                return redirect()->route('admin.mainCategories',$type)->with(['error' => 'لم يتم الاضافه']);

            }
        }
    }
    ################################end store #####################################
    ###############################edit############################
    public function edit($id){


            $mainCategory = Category::orderBy('id', 'DESC')->find($id);
            if (!$mainCategory)
                return redirect()->route('admin.mainCategories','main')->with(['error' => 'هذا القسم غير موجود']);

            return view('dashboard.categories.edit', compact('mainCategory'));

    }
    public function update(mainsCategoryRequest $request,$id){
        try {
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }

             $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.mainCategories','main')->with(['error' => 'هناك خطا ما حاول لاحقا']);
            $category->update($request->all());
            $category->name = $request->name;
            $category->save();
            return redirect()->route('admin.mainCategories','main')->with(['success' => 'تم التحديث بنجاح']);

        }
        catch (\Exception $ex ){
            return redirect()->route('admin.mainCategories','main')->with(['error' => 'هناك خطا ما حاول لاحقا']);
        }
    }
    public function delete($id){
        $mainCategory=Category::orderBy('id','DESC')->find($id);
        if(!$mainCategory)
            return redirect()->route('admin.MainCategories','main')->with(['error'=>'هذا القسم غير موجود']);
$mainCategory->delete();
        return redirect()->route('admin.mainCategories','main')->with(['success' => 'تم الحذف  بنجاح']);

    }
    public function editSub($id){


        $mainCategory = Category::orderBy('id', 'DESC')->find($id);
        if (!$mainCategory)
            return redirect()->route('admin.mainCategories','sub')->with(['error' => 'هذا القسم غير موجود']);
        $categories=Category::Parent()->orderBy('id','DESC')->get();

        return view('dashboard.categories.editsubcategory', compact('mainCategory','categories'));

    }
    public function updatesub(subCategoryRequest  $request,$id){
        try {
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }

            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.mainCategories','sub')->with(['error' => 'هناك خطا ما حاول لاحقا']);
            $category->update($request->all());
            $category->name = $request->name;
            $category->save();
            return redirect()->route('admin.mainCategories','sub')->with(['success' => 'تم التحديث بنجاح']);

        }
        catch (\Exception $ex ){
            return redirect()->route('admin.mainCategories','sub')->with(['error' => 'هناك خطا ما حاول لاحقا']);
        }
    }
    public function deletesub($id){
        $mainCategory=Category::orderBy('id','DESC')->find($id);
        if(!$mainCategory)
            return redirect()->route('admin.MainCategories','sub')->with(['error'=>'هذا الفرع غير موجود']);
        $mainCategory->delete();
        return redirect()->route('admin.mainCategories','sub')->with(['success' => 'تم الحذف  بنجاح']);

    }



}
