<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyConfig extends Model {
    //
    use SoftDeletes;

    protected $table = "survey_configs";
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
