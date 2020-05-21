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
     * The attributes for date format.
     *
     * @var array
     */
    protected $casts = [
        'created_at'  => 'datetime:m-d-Y H:00',
        'updated_at' => 'datetime:m-d-Y H:00',
    ];

    /**
     * Save User
     * 
     * @param Array $data
     * @param $id
     * @return model
     */
    public function SaveUser($data,$id=null)
    {
        
        $model = $this;

        if($id)
        {
            $model = $this->find($id);
        }
        
        $model->fill($data);
        $model->save();
        return $model;

    }

    /**
     * Delete User
     * 
     * @param $id
     * @return Bool
     */
    public function Remove($id)
    {
        $response = $this->find($id);
        return $response?$response->delete():true;
    }

}
