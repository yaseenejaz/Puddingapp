<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Zipcodes;
use App\Models\Products;
use App\Models\Sliders;
use App\Models\Favourites;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Sliders::get();
        $products = Products::get();
        $favourites = Favourites::get();
        
        return view('home', compact('sliders', 'products', 'favourites'));
    }

    public function searchZipCodes(Request $request){
        
        if($request['query']){
            //$query = explode(' ', $request['query']);

            $request_data = $request['query'];
            $q = preg_replace('/\s+/', '', $request_data);
            $zipcodes = Zipcodes::get();
          
            $searched_query_all = '';
            $ischeck = 'false';

            if(strlen($q) > 7){
                return $ischeck='false';
            }else{

                
                foreach($zipcodes as $zipcode){
                $searched_query_all .= $this->match_wildcard($zipcode->zipcode, $q);
                //return $searched_query_all;
                if(strlen($q)==strlen($zipcode->zipcode)){
                    $match = $this->match_wildcard($zipcode->zipcode, $q);
                    if($match == 1){
                        $ischeck = $zipcode->url;                    
                        
                    }
                }
            }
            return $ischeck;
            }
            
            

            // return json_encode($searched_query_all);

        //     if(Str::contains($q, '*')){
        //         //$q = str_replace('*', '_',$q);
        //         $q = preg_replace('/\s/', '', $q).'%';
        //     }
        //     /* return $q;
        //     exit();  */
            
        //     //$q = explode(' ',$request['query']);
        
        //     //$searched_query = Zipcodes::where('zipcode', 'LIKE', str_replace('*', '_', $q).'%')->get();
        //     $searched_query = DB::table('zipcodes')->where('zipcode', 'LIKE', str_replace('*', '_',$q).'%')->first();
            
        //     if($searched_query)
        //         return $searched_query->url;
        //     else
        //         return 'false';
        // }

        // if($request['queryAll']){
        //     $qa = $request['queryAll'];

        //     $searched_query_all = Zipcodes::Where('zipcode',$qa)->first();
        //     if($searched_query_all!=''){
        //         return json_encode($searched_query_all);
        //     }
        //     else{
        //         return 'false';
        //     }
                
        // }
        
        }
    }
     public function match_wildcard( $wildcard_pattern, $haystack ) {
        
        $regex = str_replace(
            array("\*", "\?"), // wildcard chars
            array('.*','.'),   // regexp chars
            preg_quote($wildcard_pattern)
        );
        return preg_match('/^'.$regex.'$/is', $haystack);
    }
   
}
