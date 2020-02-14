<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model {

    use SoftDeletes;

    protected $table = "boards";
    protected $dates = ['deleted_at'];

    // protected $with = ['user', 'thumbnail'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function thumbnail(){
        return $this->hasOne(Attachment::class, 'attachment_id')->where('attachment_type', 'boards')->orderBy('id', 'desc');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'commentable_id')->where('commentable_type', 'boards')->orderBy('id', 'desc');
    }

    public function likes(){
        return $this->hasMany(Like::class, 'like_id')->where('like_type', 'boards')->where("user_id", Auth::user()->id);
    }

}
