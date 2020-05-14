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
        'id', 'academic_year_id', 'class_id', 'email', 'password', 'reg_number', 'name', 'gender', 'father_name', 'mother_name', 'address', 'phonenumber', 'image', 'dob', 'status', 'created_at', 'updated_at'
    ];
}
