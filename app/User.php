<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $with = ['avatar'];

    public function avatar(){
        return $this->hasOne(Attachment::class, 'attachment_id')->where('attachment_type', 'avatar')->orderBy('id', 'desc');
    }

    public function boards(){
        return $this->hasMany(Board::class, 'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'user_id');
    }

}
