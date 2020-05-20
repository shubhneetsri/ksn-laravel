<?php

namespace App\Models\Student;

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
        'id', 'user_id', 'father_name', 'mother_name', 'caste', 'academic_year_id', 'admission_class_id', 'reg_number', 'created_at', 'updated_at'
    ];

    /**
     * Get User details
     */
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    /**
     * Get User details
     */
    public function class(){
        return $this->hasOne('App\Models\Student\StudentClassDetail','student_id')->where('status', '1');
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
    public function GetStudentList(){
        
        $response = [];
        $response = $this->with(['user','class.detail'])->paginate(10);
        return $response?$response->toArray():[];

    }

    /**
     * Get A Student
     * 
     * @return Array
     */
    public function GetStudent($id){

        $response = [];

        if($id)
        {
            $response = $this->with(['user','class'])->where('id',$id)->first();
            return $response?$response->toArray():[];
        }

        return $response;

    }
}
