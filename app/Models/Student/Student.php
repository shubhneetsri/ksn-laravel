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
        'id', 'user_id', 'academic_year_id', 'admission_class_id', 'reg_number', 'created_at', 'updated_at'
    ];

    /**
     * Get User details
     */
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

     /**
     * Save User
     * @param Array $data
     * @return model
     */
    public function SaveStudent($data){
        
        $this->fill($data);
        $this->save();
        return $this;

    }

    /**
     * Get student list
     * @return Array
     */
    public function GetStudentList(){
        
        $response = [];
        return $response = $this->with('user')->paginate(10)->toArray();

    }
}
