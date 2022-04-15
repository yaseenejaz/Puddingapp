<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Sliders;
use File;

class SlideController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $sliders = Sliders::get();
        return view('admin.sliders.sliders', compact('sliders'));
    }

    public function create($id=null){   
        $slider = Sliders::where('id', $id)->first();
        return view('admin.sliders.add-slider', compact('slider'));
    }

    public function store(Request $request){
        
        if($request){
            $validation = $request->validate([
                'slidename'     =>      'required',
                'slidetext'     =>      'required',
                'bgimage'       =>      'mimes:jpg,png|required|max:1000',
                'frontimage'    =>      'mimes:jpg,png|required|max:1000'
            ]);

            $slug = Str::of($request->slidename)->slug('-');

            if($request->hasFile('bgimage') && $request->hasFile('frontimage')){
                if($request->file('bgimage')->isValid() && $request->file('frontimage')->isValid()){

                    $b_image = $request->file('bgimage');
                    $f_image = $request->file('frontimage');

                    $bg = public_path('uploads/sliders/bg');
                    $fn = public_path('uploads/sliders/front');

                    $bg_path = (!File::isDirectory($bg) ? File::makeDirectory($bg, 0777, true, true) : $bg );
                    $fn_path = (!File::isDirectory($fn) ? File::makeDirectory($fn, 0777, true, true) : $fn );

                    $backgroundImage_name = $b_image->getClientOriginalName();
                    $backgroundImage_ext = $b_image->getClientOriginalExtension();
                    $backgroundImage_name = Str::replaceFirst('.'.$backgroundImage_ext, '', $backgroundImage_name);

                    $bg_upload_path = $bg_path.DIRECTORY_SEPARATOR.$backgroundImage_name.'.'.$backgroundImage_ext;

                    if($request->bgimage->move($bg_path, $backgroundImage_name.'.'.$backgroundImage_ext)){
                        
                    }else{
                        echo 'background image upload fail';
                    }

                    $frontImage_name = $request->file('frontimage')->getClientOriginalName();
                    $frontImage_ext = $request->file('frontimage')->getClientOriginalExtension();
                    $frontImage_name = Str::replaceFirst('.'.$frontImage_ext, '', $frontImage_name);

                    if($request->frontimage->move($fn_path, $frontImage_name.'.'.$frontImage_ext)){
                        
                    }else{
                        echo 'front image upload fail';
                    }


                }
            }

            $slider = Sliders::create([
                'name'          =>      $request->slidename,
                'slug'          =>      $slug,
                'slide_text'    =>      $request->slidetext,
                'bg_image'      =>      $backgroundImage_name.'.'.$backgroundImage_ext,
                'front_image'   =>      $frontImage_name.'.'.$frontImage_ext
            ]);

            return redirect('sliders')->with('success', 'Data Added Successfully!');
        }

    }


    public function update(Request $request){
         if($request){
            /* $validation = $request->validate([
                'slidename'     =>      'required',
                'slidetext'     =>      'required',
                'bgimage'       =>      'mimes:jpg,png|required|max:1000',
                'frontimage'    =>      'mimes:jpg,png|required|max:1000'
            ]); */

            $slug = Str::of($request->slidename)->slug('-');

            if($request->hasFile('bgimage')){
                if($request->file('bgimage')->isValid()){

                    $b_image = $request->file('bgimage');

                    $bg = public_path('uploads/sliders/bg');
                    
                    $bg_path = (!File::isDirectory($bg) ? File::makeDirectory($bg, 0777, true, true) : $bg );
                    
                    $backgroundImage_name = $b_image->getClientOriginalName();
                    $backgroundImage_ext = $b_image->getClientOriginalExtension();
                    $backgroundImage_name = Str::replaceFirst('.'.$backgroundImage_ext, '', $backgroundImage_name);

                    $bg_upload_path = $bg_path.DIRECTORY_SEPARATOR.$backgroundImage_name.'.'.$backgroundImage_ext;

                    if($request->bgimage->move($bg_path, $backgroundImage_name.'.'.$backgroundImage_ext)){
                        $slider = Sliders::where('id', $request->id)->limit(1)->update(
                            array(
                            'name'          =>      $request->slidename,
                            'slug'          =>      $slug,
                            'slide_text'    =>      $request->slidetext,
                            'bg_image'      =>      $backgroundImage_name.'.'.$backgroundImage_ext,
                            )
                        );
                        return redirect('sliders')->with('success', 'Data Updated Successfully!');
                    }else{
                        echo 'background image upload fail<br/>';
                    }
                }
            }

            if($request->hasFile('frontimage')){
                if($request->file('frontimage')->isValid()){

                    $f_image = $request->file('frontimage');

                    $fn = public_path('uploads/sliders/front');
                    
                    $fn_path = (!File::isDirectory($fn) ? File::makeDirectory($fn, 0777, true, true) : $fn );
                    
                    $frontImage_name = $f_image->getClientOriginalName();
                    $frontImage_ext = $f_image->getClientOriginalExtension();
                    $frontImage_name = Str::replaceFirst('.'.$frontImage_ext, '', $frontImage_name);

                    $fn_upload_path = $fn_path.DIRECTORY_SEPARATOR.$frontImage_name.'.'.$frontImage_ext;

                    if($request->frontimage->move($fn_path, $frontImage_name.'.'.$frontImage_ext)){
                        $slider = Sliders::where('id', $request->id)->limit(1)->update(
                            array(
                            'name'          =>      $request->slidename,
                            'slug'          =>      $slug,
                            'slide_text'    =>      $request->slidetext,
                            'front_image'   =>      $frontImage_name.'.'.$frontImage_ext,
                            )
                        );

                        return redirect('sliders')->with('success', 'Data Updated Successfully!');
                    }else{
                        echo 'front image upload fail<br/>';
                    }
                }
            }

            /* $db_data = Sliders::where('id',$request->id)->first();
            
            $bg_image = (!$request->bgimage) ? $db_data->bg_image : $backgroundImage_name.'.'.$backgroundImage_ext;
            $fn_image = (!$request->frontimage) ? $db_data->front_image : $frontImage_name.'.'.$frontImage_ext;

            echo 'bg ready for uqery: '.$bg_image.'<br/> fn ready for query: '.$fn_image; */
            $slider = Sliders::where('id', $request->id)->limit(1)->update(
                            array(
                            'name'          =>      $request->slidename,
                            'slug'          =>      $slug,
                            'slide_text'    =>      $request->slidetext,
                            )
                        );
            return redirect('sliders')->with('success', 'Data Updated Successfully!');
        }
    }


    public function del(Request $request){
        $id = $request['delete_id'];

        $slide = Sliders::where('id', $id)->first();

        $slide->delete();
        $slide_del = 1;

        if($slide_del){
            return $slide_del;
        }else{
            return false;
        }

    }
}
