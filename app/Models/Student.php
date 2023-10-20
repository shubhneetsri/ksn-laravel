<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Student extends Model implements Authenticatable
{

    use Notifiable, AuthenticableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ksn_students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'father_name', 'mother_name', 'caste', 'academic_year_id', 'admission_class_id', 'reg_number', 'current_address','created_at', 'updated_at'
    ];

    /**
     * Get User details
     */
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    /**
     * Get User class details
     */
    public function class(){
        return $this->hasOne('App\Models\StudentClassDetail','student_id')->where('status', '1');
    }
    
    /**
     * Get User fees details
     */
    public function fees(){
        return $this->hasMany('App\Models\StudentFees');
    }

     /**
     * Save User
     * 
     * @param Array $data
     * @return model
     */
    public function SaveStudent($data,$id=null){
        
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
     * Get student list
     * 
     * @return Array
     */
    public function GetStudentList($by=NULL,$sort=NULL)
    {    
        $response = [];

        if($by)
        {
            $data = $this->with(['user','class.detail']);

            if ($by == 'name' || $by == 'updated_at') 
            {
                $data->whereHas('user', function($query) use ($by,$sort) {
                    return $query->orderBy($by, $sort);
                });
            }

            if ($by == 'roman_name' || $by == 'roman_name') 
            {
                $data->whereHas('class.detail', function($query) use ($by,$sort) {
                    return $query->orderBy($by, $sort);
                });
            }


            if($by == 'father_name' || $by == 'caste' || $by == 'reg_number')
            {
                $data->orderBy($by, $sort);
            }
            
            $response = $data->paginate(10);
        }
        else
        {
            $response = $this->with(['user','class.detail'])->paginate(10);
        }
        
        return $response?$response->toArray():[];

    }

    /**
     * Get A Student
     * 
     * @return Array
     */
    public function GetStudent($id)
    {
        $response = [];

        if($id)
        {
            $response = $this->with(['user','class'])->where('id',$id)->first();
            return $response?$response->toArray():[];
        }

        return $response;

    }

    /**
     * Delete Student
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
