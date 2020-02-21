<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Banner;
use App\SurveyConfig;

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

        $crr_date = date('Y-m-d H:i:s');

        $surveys = SurveyConfig::where('period_yn', 'N')->orWhere([
            ['started_at', '<=', $crr_date],
            ['finished_at', '>=', $crr_date]
        ])->orderBy('id', 'desc')->get();

        // echo "<pre>";
        // print_r($surveys->toArray());
        // echo "</pre>";
        // exit;

        return view('home', compact('banners', 'surveys'));

    }

}
