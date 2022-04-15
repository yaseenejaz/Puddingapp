<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Products;
use File;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $products = Products::get();
        return view('admin.products.products', compact('products'));
    }

    public function create($id=null){
        $product = Products::where('id',$id)->first();

        return view('admin.products.add-products', compact('product'));

    }

    public function store(Request $request){
       
        if($request){

            $fav = (!$request->favourite ? 0 : 1);
            $slug = Str::of($request->name)->slug('-');

            $validation = $request->validate([
                'name'          =>      'required',
                'price'         =>      'required|integer',
                'producturl'    =>      'required',
                'image'         =>      'mimes:jpeg,jpg,png|required',
            ]);


            if($request->hasFile('image') && $request->file('image')->isValid()){
                
                $products_folder = public_path('uploads/product-images');

                $prods_path = (!File::isDirectory($products_folder) ? File::makeDirectory($products_folder, 0777, true, true) : $products_folder);

                $prod_image_name = $request->file('image')->getClientOriginalName();
                $prod_image_ext = $request->file('image')->getClientOriginalExtension();
                $prod_image_name = Str::replaceFirst('.'.$prod_image_ext, '', $prod_image_name);

                if($request->image->move($prods_path, $prod_image_name.'.'.$prod_image_ext)){
                    $prods = Products::create([
                        'name'          =>      $request->name,
                        'slug'          =>      $slug,
                        'price'         =>      $request->price,
                        'product_url'   =>      $request->producturl,
                        'image'         =>      $prod_image_name.'.'.$prod_image_ext,
                        //'is_favourite'  =>      $fav
                    ]);
                    return redirect('products')->with('success', 'Product Created Successfully');
                }else{
                    echo 'failed to upload';
                }
            }
        }
       
    }

    public function update(Request $request){
       if($request){

            $fav = (!$request->favourite ? 0 : 1);
            $slug = Str::of($request->name)->slug('-');

            $validation = $request->validate([
                'name'          =>      'required',
                'price'         =>      'required',
                'producturl'    =>      'required',
                'image'         =>      'mimes:jpeg,jpg,png',
            ]);


            if($request->hasFile('image') && $request->file('image')->isValid()){
                
                $products_folder = public_path('uploads/product-images');

                $prods_path = (!File::isDirectory($products_folder) ? File::makeDirectory($products_folder, 0777, true, true) : $products_folder);

                $prod_image_name = $request->file('image')->getClientOriginalName();
                $prod_image_ext = $request->file('image')->getClientOriginalExtension();
                $prod_image_name = Str::replaceFirst('.'.$prod_image_ext, '', $prod_image_name);

                if($request->image->move($prods_path, $prod_image_name.'.'.$prod_image_ext)){
                    $prods = Products::where('id', $request->id)->limit(1)->update(
                        array(
                            'name'          =>      $request->name,
                            'slug'          =>      $slug,
                            'price'         =>      $request->price,
                            'product_url'   =>      $request->producturl,
                            'image'         =>      $prod_image_name.'.'.$prod_image_ext,
                            'is_favourite'  =>      $fav
                        )
                    );
                    return redirect('products')->with('success', 'Product Updated Successfully');
                }else{
                    return redirect('products')->with('error', 'File upload failed');
                }
            }

            $prods = Products::where('id', $request->id)->limit(1)->update(
                    array(
                        'name'          =>      $request->name,
                        'slug'          =>      $slug,
                        'price'         =>      $request->price,
                        'product_url'   =>      $request->producturl,
                        'is_favourite'  =>      $fav
                    )
                );
            return redirect('products')->with('success', 'Product Updated Successfully');
                       
        }
    }


    public function del(Request $request){
        $id = $request['delete_id'];
        $products = Products::where('id', $id)->first();

        $products->delete();
        $product_del = 1;

        if($product_del){
            return $product_del;
        }else{
            return false;
        }
    }
    
}
