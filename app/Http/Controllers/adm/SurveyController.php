<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\SurveyConfig;

class SurveyController extends Controller {
    //

    private function configs_rules(){
        return [
            'name' => 'required|max:255',
            'intro' => 'required',
            'period_yn' => 'required',
            'authenticate' => 'required'
        ];
    }

    private function add_user_period_term(){

        return [
            'started_at' => 'required|date',
            'finished_at' => 'required|date|after:started_at'
        ];

    }

    private function personal_infomations_rules($inputs = array()){

        if(empty($inputs)) return [];

        $replaces = [
            'birth' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'phone' => 'required|min:11|numeric'
        ];

        $ret = [];

        foreach($inputs as $input){
            if(isset($replaces[$input])) $ret[$input] = $replaces[$input];
        }

        return $ret;

    }

    public function index(){

        $per_page = 15;
        $survey_cfgs = SurveyConfig::with(['user'])->orderBy('id', 'desc')->paginate($per_page);

        $privates = array();
        foreach($survey_cfgs as $cfg){
            $collects = json_decode($cfg->personal_infomations, true);
            $privates[$cfg->id] = (count($collects) == 0) ? '': implode(', ', array_keys($collects));
        }

        return view('adm.surveys.list', compact('survey_cfgs', 'privates'));

    }

    public function create(){

        $route = route('adm.surveys.store');
        $period_yn = (!empty(old('period_yn'))) ? old('period_yn'): 'N';
        $authenticate = (!empty(old('authenticate'))) ? old('authenticate'): 'Y';
        $personal_infomations = (!empty(old('personal_infomations'))) ? old('personal_infomations'): [];

        return view('adm.surveys.form', compact('route', 'period_yn', 'authenticate', 'personal_infomations'));

    }

    public function store(Request $request){

        $request->validate($this->configs_rules());

        if($request->period_yn == 'Y'){
            $request->validate($this->add_user_period_term());
        }

        $personal_infomations = $this->personal_infomations_rules($request->personal_infomations);

        $survey_cfg = new SurveyConfig();
        $survey_cfg->name = $request->name;
        $survey_cfg->user_id = Auth::id();
        $survey_cfg->intro = $request->intro;
        $survey_cfg->period_yn = $request->period_yn;
        $survey_cfg->authenticate = $request->authenticate;
        $survey_cfg->started_at = $request->started_at;
        $survey_cfg->finished_at = $request->finished_at;
        $survey_cfg->descr = $request->descr;
        $survey_cfg->policy = $request->policy;
        $survey_cfg->marketing_terms = $request->marketing_terms;
        $survey_cfg->personal_infomations = json_encode($personal_infomations);
        $survey_cfg->save();

        return redirect()->route('adm.surveys.index');

    }

    public function edit(Request $request, $id){

        $survey_cfg = SurveyConfig::with(['applicants.user'])->find($id);

        $route = route('adm.surveys.update', ['id' => $id]);
        $period_yn = $survey_cfg->period_yn;
        $authenticate = $survey_cfg->authenticate;

        $terms = json_decode($survey_cfg->personal_infomations, true);
        $personal_infomations = (empty($terms)) ? []: array_keys($terms);

        return view('adm.surveys.form', compact('route', 'survey_cfg', 'period_yn', 'authenticate', 'personal_infomations'));

    }

    public function update(Request $request, $id){

        $request->validate($this->configs_rules());

        if($request->period_yn == 'Y'){
            $request->validate($this->add_user_period_term());
        }

        $personal_infomations = $this->personal_infomations_rules($request->personal_infomations);

        $survey_cfg = SurveyConfig::find($id);
        $survey_cfg->name = $request->name;
        $survey_cfg->user_id = Auth::id();
        $survey_cfg->intro = $request->intro;
        $survey_cfg->period_yn = $request->period_yn;
        $survey_cfg->authenticate = $request->authenticate;
        $survey_cfg->started_at = $request->started_at;
        $survey_cfg->finished_at = $request->finished_at;
        $survey_cfg->descr = $request->descr;
        $survey_cfg->policy = $request->policy;
        $survey_cfg->marketing_terms = $request->marketing_terms;
        $survey_cfg->personal_infomations = json_encode($personal_infomations);
        $survey_cfg->save();

        return redirect()->route('adm.surveys.index');

    }

    public function destroy(Request $request, $id){
        SurveyConfig::destroy($id);
        return redirect()->route('adm.surveys.index');
    }

}
