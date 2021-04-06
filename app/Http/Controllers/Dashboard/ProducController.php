<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\imageRiquest;
use App\Http\Requests\priceRiquest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\storeRiquest;
use App\models\Brand;
use App\models\Category;
use App\models\Image;
use App\models\Product;
use App\models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class ProducController extends Controller
{
    public function index(){
        $products=Product::select('id','slug','price','created_at')->paginate(PAGINATION_COUNT);//paginate(PAGINATION_COUNT);
        return view('dashboard.products.index',compact('products'));
    }
    public function create(){
        $data=[];
        $data['categories']=Category::active()->select('id')->get();
        $data['brands']=Brand::select('id')->get();
        $data['tags']=Tag::active()->select('id')->get();

        return view('dashboard.products.create',$data);
    }
    public  function store(ProductRequest $request){
        try {

            DB::beginTransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }
        $product = Product::create($request->except('_token'));
            $product->name = $request->name;
            $product->description=$request->description;
            $product->short_description=$request->short_description;
            $product->save();
            $product->categories()->attach($request->categories);
            $product->tags()->attach($request->tags);
            return redirect()->route('admin.product')->with(['success' => 'تم الاضافه بنجاح']);
            DB::commit();

        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.product')->with(['error' => 'لم يتم الاضافه']);

        }

    }
    public function price($product_id){
        $price=Product::find($product_id);
        $product_id=$product_id;
        return view('dashboard.products.price.create',compact('price'))->with('product_id',$product_id);
    }
    public function storePrice(priceRiquest $riquest){

        try {

           Product::whereId($riquest->product_id)->update($riquest->only(['price','special_price','special_price_start','special_price_end','special_price_type']));


            return redirect()->route('admin.product')->with(['success' => 'تم التحديث بنجاح']);

        }
        catch (Exception $ex){
            return redirect()->route('admin.product')->with(['error' => 'لم يتم التحديث']);
        }
    }
    public function stock($product_id){
        $product_id=$product_id;
        return view('dashboard.products.stock.create')->with('product_id',$product_id);
    }
    public function storestock(storeRiquest $riquest){


        try {
            Product::whereId($riquest->product_id)->update($riquest->only(['sku','manage_stock','qty','in_stock']));


            return redirect()->route('admin.product')->with(['success' => 'تم التحديث بنجاح']);

        }
        catch (Exception $ex){
            return redirect()->route('admin.product')->with(['error' => 'لم يتم التحديث']);
        }
    }
    public function images($product_id){
$product_id=$product_id;
$images=Image::select('photo','id')->where('product_id',$product_id)->get();

        return view('dashboard.products.images.create',compact('images'))->with('product_id',$product_id);
    }
    public function storeimages(Request $request){
        $file=$request->file('dzfile');
        $filename=uploadimage('products',$file);
        return response()->json([
            'name'=>$filename,
            'orignal_name'=>$file->getClientOriginalName()
        ]);
    }
    public function storeimages_DB(imageRiquest $request){

        try {

            if($request->has('document') && count($request->document)>0){
                foreach ($request->document as $image){
                    Image::create([
                       'product_id'=>$request->product_id,
                       'photo'=>$image
                    ]);
                }
                return redirect()->route('admin.product')->with(['success' => 'تم التحديث بنجاح']);
            }


        }catch (\Exception $ex){
            return redirect()->route('admin.product')->with(['error' => 'لم يتم التحديث']);
        }

    }
    public function Deleteimages($image_id){
        try {
            $image=Image::find($image_id);
            if(!$image){
                return redirect()->route('admin.product')->with(['error' => 'هذه الصوره غير موجوده']);
            }
            $image->delete();
            return redirect()->route('admin.product')->with(['success' => 'تم الحذف بنجاح']);

        }catch (\Exception $ex){
            return redirect()->route('admin.product')->with(['error' => 'لم يتم الحذف']);
        }
    }


}
