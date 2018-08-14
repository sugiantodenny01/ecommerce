<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use Yajra\DataTables\DataTables;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //

    public function  __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        return view('products.index',['products'=>Product::all()]);
    }

    public function table(){
        $product=product::query();

        return DataTables::of($product)
            ->addColumn('action',function ($data){
                return
                    '<a  href="'. route('products.edit', ['id' => $data->id ]).'" class="btn btn-primary btn-xs" style="width: 50%;"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<form action="'. route('products.destroy', ['id' => $data->id ]) .'" method="post">
                                                       '.csrf_field().'  
                                                       '.method_field('DELETE').' 
                                                      <button class="btn btn-danger btn-xs" style="margin-top: 10px ; width: 50%;"><i class="glyphicon glyphicon-trash"></i>Delete</button>
                    </form>';
            })
            ->make(true);

    }

    public function create(){
        return view('products.create');
    }

    public  function  store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'image'=>'required|image'
        ]);

        $product = new product();

        $image       = $request->file('image');
        $filename    = $image->getClientOriginalName();

        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('uploads/products/' .$filename));

//        $product_image= $request->image;
//        $product_image_new_name= time().$product_image->getClientOriginalName();
//        $product_image->move('uploads/products',$product_image_new_name);

        $product->name=$request->name;
        $product->description=$request->description;
        $product->price=$request->price;
//        $product->image='uploads/products/'.$product_image_new_name;
        $product->image='uploads/products/'.$filename;

        $product->save();

        Session::flash('success','product created');

        return redirect()->route('products.index');

    }

    public function  show($id){
      return view('products.show',['product'=>product::find($id)]);
    }

    public function  edit($id){
        return view('products.edit',['product'=>product::find($id)]);
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
         ]);

        $product=product::find($id);

        if ($request->hasFile('image')){
            $image       = $request->file('image');
            $filename    = $image->getClientOriginalName();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            $image_resize->save(public_path('uploads/products/' .$filename));

            $product->image='uploads/products/'.$filename;
            $product->save();
        }

        $product->name=$request->name;
        $product->description=$request->description;
        $product->price=$request->price;

        $product->save();

        Session::flash('success','product updated');

        return redirect()->route('products.index');


    }

    public function  destroy($id){
        $product=product::find($id);

        if (file_exists($product->image)){
            unlink($product->image);
        }

        $product->delete();

        Session::flash('success','product deleted');

        return redirect()->back();

    }


}
