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

        # 회원만 참여가능한지 구분
        if($survey_cfg->authenticate == 'Y'){
            # 로그인 안한 사람
            if(Auth::check() == false) return redirect()->route('login');
            # 이미 참여한 사람
            if(Survey::where('survey_id', $event_id)->where('user_id', Auth::id())->exists() == true) return redirect(url()->previous());
        }

        # 수집항목
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

        # 회원만 참여가능한지 구분
        if($survey_cfg->authenticate == 'Y'){
            # 로그인 안한 사람
            if(Auth::check() == false) return redirect()->route('login');
            # 이미 참여한 사람
            if(Survey::where('survey_id', $event_id)->where('user_id', Auth::id())->exists() == true) return redirect(url()->previous());
        }

        $rules = [
            'name' => 'required|min:2'
        ];

        $collects = json_decode($survey_cfg->personal_infomations, true);

        # 기본적인 검증 대상 + 관리자에서 설정한 개인정보 수집항목 폼 검증
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

        # 참여자수 증가
        SurveyConfig::find($event_id)->increment('applicant_count');

        return redirect()->route('home');

    }
    
}
