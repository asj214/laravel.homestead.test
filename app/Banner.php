<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model {
    //
    use SoftDeletes;

    protected $table = "banners";
    protected $dates = ['deleted_at'];

    public function attachment(){
        return $this->hasOne(Attachment::class, 'attachment_id')->where('attachment_type', 'banners')->orderBy('id', 'desc');
    }

}
