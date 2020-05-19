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
        'id', 'user_type', 'name', 'email', 'password', 'gender', 'phonenumber', 'image', 'dob', 'address', 'state_id', 'city_id', 'status'
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
     * Save User
     * @param Array $data
     * @return model
     */
    public function SaveUser($data){
        
        $this->fill($data);
        $this->save();
        return $this;

    }

}
