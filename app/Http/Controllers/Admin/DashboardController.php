<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Products;
use App\Models\Sliders;
use App\Models\Zipcodes;
use App\Models\Favourites;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $products = Products::get();
        $sliders = Sliders::get();
        $zipcodes = Zipcodes::get();
        $favourites = Favourites::get();
        return view('admin.dashboard', compact('products', 'sliders', 'zipcodes', 'favourites'));
    }

    public function logsout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
