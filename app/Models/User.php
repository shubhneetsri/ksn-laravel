<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_type', 'name', 'email', 'password', 'gender', 'phonenumber', 'image', 'dob', 'address', 'state_id', 'city_id', 'status', 'access_token', 'refresh_access_token'
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

    /**
     * Get User
     * 
     * @return Array
     */
    public function GetUser($id)
    {
        $response = [];

        if($id)
        {
            $response = $this->where('id',$id)->first();
            return $response?$response->toArray():[];
        }

        return $response;

    }
}
