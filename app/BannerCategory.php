<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerCategory extends Model {
    //
    use SoftDeletes;

    protected $table = "banner_categorys";
    protected $dates = ['deleted_at'];

}
