<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\SurveyConfig;
use App\Survey;

class SurveyController extends Controller {

    //
    public function show(Request $request, $event_id){
    }

    public function create(Request $request, $event_id){

        $survey_cfg = SurveyConfig::find($event_id);
        $collects = json_decode($survey_cfg->personal_infomations, true);
        $privates = (empty($collects)) ? []: array_keys($collects);

        // echo "<pre>";
        // print_r($survey_cfg->toArray());
        // echo "</pre>";
        // exit;

        return view('surveys.form', compact('survey_cfg', 'privates'));

    }

    public function store(Request $request, $event_id){

        $survey_cfg = SurveyConfig::find($event_id);

        $rules = [
            'name' => 'required|min:2'
        ];

        $collects = json_decode($survey_cfg->personal_infomations, true);

        $request->validate(array_merge($rules, $collects));

        $survey = new Survey();
        $survey->survey_id = $event_id;
        $survey->user_id = Auth::id();
        $survey->name = $request->name;
        $survey->gender = $request->gender;
        $survey->email = $request->email;
        $survey->birth = $request->birth;
        $survey->phone = $request->phone;
        $survey->save();

        return redirect()->route('home');

    }
    
}
