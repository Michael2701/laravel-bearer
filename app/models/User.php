<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $hidden = ['password'];

    public function roles(){
        //return $this->hasMany()
    }
}
