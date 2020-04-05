<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

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
        'id', 'academic_year_id', 'class_id', 'reg_number', 'name', 'gender', 'father_name', 'mother_name', 'address', 'phonenumber', 'image', 'dob', 'status', 'created_at', 'updated_at'
    ];
}
