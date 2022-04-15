<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

use App\Models\User;
use File;


class AdminController extends Controller
{
    public function __construct(){
        
    }

    public function index(){
        $admin = User::where('id',1)->first();
        return view('admin.profile.admin-profile', compact('admin'));
    }

    public function update(Request $request, $id){

        
        if($request){
            $validation = $request->validate([
                'name'      =>      'required',
                'userpost'  =>      'required',
                'email'     =>      'required',
                'image'     =>      'image|mimes:jpg,jpeg,png|dimensions:max_width=300,max_height=300'
            ]);

            if($request->hasFile('image') && $request->file('image')->isValid()){
                $avatar_folder = public_path('uploads/admin-avatar');

                $avatar_path = (!File::isDirectory($avatar_folder) ? File::makeDirectory($avatar_folder, 0777, true, true) : $avatar_folder );

                $avatar_name = $request->file('image')->getClientOriginalName();
                $avatar_ext = $request->file('image')->getClientOriginalExtension();
                $avatar_name = Str::replaceFirst('.'.$avatar_ext, '', $avatar_name);
                
                if($request->image->move($avatar_path, $avatar_name.'.'.$avatar_ext)){
                    $user = User::where('id',1)->limit(1)->update(
                        array(
                            'name'      =>      $request->name,
                            'email'     =>      $request->email,
                            'user_post' =>      $request->userpost,
                            'image'     =>      $avatar_name.'.'.$avatar_ext
                        )
                    );
                    return redirect('admin-profile')->with('success', 'Data Added Successfully');
                }else{
                    return back()->with('error', 'Action failed, try again.');
                }
            }
            $user = User::where('id',1)->limit(1)->update(
                        array(
                            'name'      =>      $request->name,
                            'email'     =>      $request->email,
                            'user_post' =>      $request->userpost,
                        )
                    );
                    return redirect('admin-profile')->with('success', 'Data Added Successfully');
        }   
        
        
        

    }

    public function updatepass(Request $request, $id){
        if($request){
            $validation =  $request->validate([
                'oldpassword'       =>  'required',
                'newpassword'       =>  'required',
                'confirmpassword'   =>  'required|same:newpassword'
            ]);

            $user = User::find($id);
            $dbPass = $user->password;

            if(!Hash::check($request->oldpassword, $dbPass)){
                return back()->with('error', 'Password not matched with old password');
            }else{
                //return redirect('admin-profile#cp')->with('success', 'New pass and Old pass matched');
                if(Hash::check($request->newpassword, $dbPass)){
                    return back()->with('error', 'New password and Old password can not be same');
                }else{
                    $admin = User::where('id', 1)->update(array('password'=>Hash::make($request->newpassword)));
                    return redirect('admin-profile')->with('success', 'Password Changed');
                }
            }

            /* if($request->newpassword !== $request->confirmpassword){
                return back()->with('error', 'New password and retype do not match');
            }else{
                return redirect('admin-profile#cp')->with('success', 'new pass and retype pass matched');
            } */
        }  
    }


    public function messages(){
        return [
            'cpass.required'    =>  'Please type old password',
        ];
    }

        
}
