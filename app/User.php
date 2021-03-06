<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar','name','pseudo', 'email', 'password',
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

    public function getAvatar() {
         if (!$this->avatar) {
             return '/img/avatar.png';
         }
         return $this->avatar;
    }

    public function following(){
        //Relation à plusieurs n à n //table 'follows', follower_id < user_id 
        return $this->belongsToMany(User::class, 'follows','user_id', 'follower_id')->withPivot('created_at');
        }
    public function followers(){
        //Relation à plusieurs n à n //table 'follows', follower_id > user_id 
        Return $this->belongsToMany(User::class, 'follows', 'follower_id', 'user_id')->withPivot('created_at');
        }
    public function posts() {
        return $this->hasMany(\App\Post::class, 'user_id');
    }
}
