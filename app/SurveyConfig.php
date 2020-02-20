<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyConfig extends Model {
    //
    use SoftDeletes;

    protected $table = "boards";
    protected $dates = ['deleted_at'];





}
