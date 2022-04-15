<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Favourites;
use File;

class FavouritesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $products = Favourites::get();
        return view('admin.favourites.favourites', compact('products'));
    }

    public function create($id=null){
        $product = Favourites::where('id', $id)->first();
        return view('admin.favourites.add-favourite', compact('product'));
    }

    public function store(Request $request){
        
        if($request){
            $validation = $request->validate([
                'name'          =>  'required',
                'producturl'    =>  'required',
                'image'         =>  'required|image|mimes:jpeg,jpg,png|dimensions:max_width=400,max_height=400'
            ]);
        }

        $slug = Str::of($request->name)->slug('-');
        
        if($request->hasFile('image') && $request->file('image')->isValid()){

            $fav_folder = public_path('uploads/favourite-products');
            
            $fav_path = (!File::isDirectory($fav_folder)) ? File::makeDirectory($fav_folder, 0777, true, true) : $fav_folder;
            
            $fav_prod_name = $request->file('image')->getClientOriginalName();
            $fav_prod_ext = $request->file('image')->getClientOriginalExtension();
            $fav_prod_name = Str::replaceFirst('.'.$fav_prod_ext, '', $fav_prod_name);
            
            $favProductName = $fav_prod_name.'.'.$fav_prod_ext;

            if($request->image->move($fav_path, $favProductName)){
                $fav = Favourites::create([
                    'name'          =>      $request->name,
                    'slug'          =>      $slug,
                    'product_url'   =>      $request->producturl,
                    'product_image' =>      $favProductName
                ]);
                return redirect('favourite-products')->with('success', 'Product Added Successfully');
            }else{
                return redirect('favourite-products')->with('error', 'Adding Product Failed, try again');
            }

        }
    }


    public function update(Request $request){
        
        if($request){
            $validation = $request->validate([
                'name'          =>  'required',
                'producturl'    =>  'required',
                'image'         =>  'image|mimes:jpeg,jpg,png|dimensions:max_width=400,max_height=400'
            ]);
        }

        $slug = Str::of($request->name)->slug('-');
        
        if($request->hasFile('image') && $request->file('image')->isValid()){

            $fav_folder = public_path('uploads/favourite-products');
            
            $fav_path = (!File::isDirectory($fav_folder)) ? File::makeDirectory($fav_folder, 0777, true, true) : $fav_folder;
            
            $fav_prod_name = $request->file('image')->getClientOriginalName();
            $fav_prod_ext = $request->file('image')->getClientOriginalExtension();
            $fav_prod_name = Str::replaceFirst('.'.$fav_prod_ext, '', $fav_prod_name);
            
            $favProductName = $fav_prod_name.'.'.$fav_prod_ext;

            if($request->image->move($fav_path, $favProductName)){
                
                $fav = Favourites::where('id',$request->id)->limit(1)->update(
                    array(
                        'name'          =>      $request->name,
                        'slug'          =>      $slug,
                        'product_url'   =>      $request->producturl,
                        'product_image' =>      $favProductName
                    )
                );
                
                return redirect('favourite-products')->with('success', 'Product Updated Successfully');
            }else{
                return redirect('favourite-products')->with('error', 'Updating Product Failed');
            }

        }

        $fav = Favourites::where('id',$request->id)->limit(1)->update(
                    array(
                        'name'          =>      $request->name,
                        'slug'          =>      $slug,
                        'product_url'   =>      $request->producturl,
                    )
                );
        return redirect('favourite-products')->with('success', 'Product Updated Successfully');
    }


    public function del(Request $request){
        $id = $request['delete_id'];
        $products = Favourites::where('id', $id)->first();

        $products->delete();
        $product_del = 1;

        if($product_del){
            return $product_del;
        }else{
            return false;
        }
    }
}
