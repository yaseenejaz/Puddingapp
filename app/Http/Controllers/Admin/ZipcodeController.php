<?php

namespace App\Http\Controllers\Admin;

use App\Models\Zipcodes;
//use App\Zipcodes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ZipcodeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $zipcodes = Zipcodes::get();
        
        return view('admin.zipcode.zipcodes', compact('zipcodes'));
    }

    public function addZipcodes($id=null){
        $zipcode = Zipcodes::where('id', $id)->first();
        return view('admin.zipcode.add-zipcode', compact('zipcode'));
    }

    public function saveZipCode(Request $request){
        if($request){

            $validate = $request->validate([
                'name'      =>  'required',
                'zipcode'   =>  'required',
                'url'       =>  'required'
            ]);
            $slug = Str::of($request->name)->slug('-');


            $zipcode = Zipcodes::create([
                'name'      =>      $request->name,
                'slug'      =>      $slug,
                'zipcode'   =>      $request->zipcode,
                'url'       =>      $request->url
            ]);

            if($zipcode){
                
                return redirect('zipcodes')->with('success', 'Data Successfully Added!!');
            }else{
                return redirect('zipcodes')->with('error', 'Fail');
            }
        }
    }

    public function editZipcode($id=null){
        $zipcode = Zipcodes::where('id', $id)->first();
        return view('admin.zipcode.add-zipcode', compact('zipcode'));
    }

    public function updateZipcode(Request $request){
         if($request){

            $validate = $request->validate([
                'name'      =>  'required',
                'zipcode'   =>  'required',
                'url'       =>  'required'
            ]);
            $slug = Str::of($request->name)->slug('-');


            $zipcode = Zipcodes::where('id', $request->id)->limit(1)->update(
                array(
                    'name'      =>      $request->name,
                    'slug'      =>      $slug,
                    'zipcode'   =>      $request->zipcode,
                    'url'       =>      $request->url 
                )
            );

            if($zipcode){
                return redirect('zipcodes')->with('success', 'Data Successfully Updated!!');
            }else{
                return redirect('zipcodes')->with('error', 'Fail');
            }
        }
    }

    public function del(Request $request){
        $id = $request['delete_id'];

        $zip = Zipcodes::where('id', $id)->first();

        $zip->delete();
        $zip_del = 1;

        if($zip_del){
            return $zip_del;
        }else{
            return false;
        }

    }
}
