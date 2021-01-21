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
    public function index(){




 $categories=Category::paginate(PAGINATION_COUNT);
 return view('dashboard.categories.index',compact('categories'));



    }
    public function create(){

             $categories= $categories=Category::with('_parent')->select('id','parent_id')->get();

            return view('dashboard.categories.create',compact('categories'));

    }
##############################store######################

    public function store(mainCategoryRequest $request){



            try {

                DB::beginTransaction();
                if (!$request->has('is_active')) {
                    $request->request->add(['is_active' => 0]);
                } else {
                    $request->request->add(['is_active' => 1]);
                }
                #####That main he will go to sub category
                if($request->typeradio==2){
                    $category = Category::create($request->except('_token'));
                    $category->name = $request->name;
                    $category->save();
                    return redirect()->route('admin.mainCategories')->with(['success' => 'تم الاضافه بنجاح']);
                }
                ######he will go to main category
                $request->request->add(['parent_id' => null]);
                $category = Category::create($request->except('_token'));
                $category->name = $request->name;
                $category->save();
                return redirect()->route('admin.mainCategories')->with(['success' => 'تم الاضافه بنجاح']);
                DB::commit();

            } catch (Exception $ex) {
                DB::rollback();
                return redirect()->route('admin.mainCategories')->with(['error' => 'لم يتم الاضافه']);

            }


    }
    ################################end store #####################################
    ###############################edit############################
    public function edit($id){


            $mainCategory = Category::orderBy('id', 'DESC')->find($id);
        $categories=Category::with('_parent')->orderBy('id','DESC')->get();
            if (!$mainCategory)
                return redirect()->route('admin.mainCategories')->with(['error' => 'هذا القسم غير موجود']);

            return view('dashboard.categories.edit', compact('mainCategory'),compact('categories'));

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
                return redirect()->route('admin.mainCategories')->with(['error' => 'هناك خطا ما حاول لاحقا']);
            $category->update($request->all());
            $category->name = $request->name;
            $category->save();
            return redirect()->route('admin.mainCategories')->with(['success' => 'تم التحديث بنجاح']);

        }
        catch (\Exception $ex ){
            return redirect()->route('admin.mainCategories')->with(['error' => 'هناك خطا ما حاول لاحقا']);
        }
    }
    public function delete($id){
        $mainCategory=Category::orderBy('id','DESC')->find($id);

        if(!$mainCategory)
            return redirect()->route('admin.MainCategories')->with(['error'=>'هذا القسم غير موجود']);


        $mainCategory->cat_trans()->delete();
       $mainCategory->sub_category()->delete();
        $mainCategory->delete();




        return redirect()->route('admin.mainCategories')->with(['success' => 'تم الحذف  بنجاح']);

    }






}
