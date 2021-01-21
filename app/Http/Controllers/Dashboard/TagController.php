<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\models\Tag;
use Illuminate\Http\Request;
use DB;

class TagController extends Controller
{
public function index(){
    $tags=Tag::paginate(PAGINATION_COUNT);
    return view('dashboard.tags.index',compact('tags'));
}
    public function create(){
        return view('dashboard.tags.create');
    }
    public function store(TagRequest $request){
        try {

            DB::beginTransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }
            $tag = Tag::create($request->except('_token'));
            $tag->name = $request->name;
            $tag->save();
            return redirect()->route('admin.tag')->with(['success' => 'تم الاضافه بنجاح']);
            DB::commit();

        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.tag')->with(['error' => 'لم يتم الاضافه']);

        }
    }
    public function edit($id){
    $tag=Tag::orderBy('id', 'DESC')->find($id);
    return view('dashboard.tags.edit',compact('tag'));
    }
    public function update(TagRequest $request,$id){
        try {
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }

            $tag = Tag::find($id);
            if (!$tag)
                return redirect()->route('admin.tag')->with(['error' => 'هناك خطا ما حاول لاحقا']);
            $tag->update($request->except('_token','id'));
            $tag->name = $request->name;
            $tag->save();
            return redirect()->route('admin.tag')->with(['success' => 'تم التحديث بنجاح']);

        }
        catch (\Exception $ex ){
            return redirect()->route('admin.tag')->with(['error' => 'هناك خطا ما حاول لاحقا']);
        }
    }
    public function delete($id){
        $tag=Tag::find($id);
        if(!$tag)
             return redirect()->route('admin.tag')->with(['error' => 'هناك خطا ما حاول لاحقا']);
        $tag->delete();
        return redirect()->route('admin.tag')->with(['success' => 'تم الحذف بنجاح']);
    }


}
