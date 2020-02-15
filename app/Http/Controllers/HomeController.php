<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;

class HomeController extends Controller {

    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function index(){

        $crr_date = date('Y-m-d H:i:s');
        $banners = Banner::where('sub_category_id', 2)
                    ->where('started_at', '<=', $crr_date)
                    ->where('finished_at', '>=', $crr_date)
                    ->where('display_yn', 'Y')->orderBy('id', 'desc')->get();




        return view('home', compact('banners'));
    }

}
