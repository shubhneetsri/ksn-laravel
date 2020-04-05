<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;

class StudentClassDetail extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ksn_student_class_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'student_id', 'class_id', 'academic_year_id', 'created_at', 'updated_at'
    ];
}
