<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {

    use SoftDeletes;

    protected $table = "comments";
    protected $dates = ['deleted_at'];
    protected $with = ['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function user_avatar(){
        return $this->hasOne(Attachment::class, 'attachment_id', 'user_id')->where('attachment_type', 'avatar')->orderBy('id', 'desc');
    }

}
