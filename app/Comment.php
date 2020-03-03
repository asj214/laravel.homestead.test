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

    public function answers(){
        return $this->hasMany(Comment::class, 'group_id')->where('depth', '>', 1);
    }

    // public function scopeAnswers($query, $group_id){
    //     return $query->where('group_id', $group_id)->where('commentable_type', 'boards')->where('depth', '>', 1);
    // }

}
