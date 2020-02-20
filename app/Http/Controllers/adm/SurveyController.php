<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SurveyConfig;

class SurveyController extends Controller {
    //
    public function index(){
        return view('adm.surveys.list');
    }

    public function create(){

        $route = route('adm.surveys.store');
        $period_yn = 'N';

        return view('adm.surveys.form', compact('route', 'period_yn'));
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
