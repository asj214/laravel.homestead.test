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

    public function create(){
        return view('adm.banners.form');
    }

    public function store(){

    }

    public function edit(Request $request, $id){

    }

    public function update(Request $request, $id){

    }

    public function destroy(Request $request, $id){

    }

}
