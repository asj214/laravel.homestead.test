<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Banner;

class BannerController extends Controller {

    public function __construct(){
        // $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    //
    public function index(){
        return view('adm.banners.lists');
    }

}
