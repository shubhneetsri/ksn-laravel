<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFees extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ksn_student_fees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'student_id', 'academic_year_id', 'fee_id', 'admission_fee',
        'development_fee', 'other_fee', 'march', 'april', 'march', 'may', 'june', 'july', 'aug', 'sept', 'oct', 'nov', 'dec', 'jan', 'feb', 'created_at', 'updated_at'
    ];

    /**
     * Get fee details
     * 
     * @return Object
     */
    public function fee_detail() {
        return $this->belongsTo('App\Models\Fee', 'fee_id');
    }

    /**
     * Get student details
     * 
     * @return Object
     */
    public function student() {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function getStudentFeeDetail($id, $academic_year_id) {
        $response = $this->where('student_id', $id)->where('academic_year_id', $academic_year_id)->first();
        return $response ? $response->toArray() : [];
    }

    /**
     * Get student fees list
     * 
     * @return Array
     */
    public function GetStudentFeeList($by = NULL, $sort = NULL) {
        $response = [];

        $response = $this->with(['fee_detail', 'student.user'])->paginate(10);
        //

        return $response ? $response->toArray() : [];
    }

    /**
     * Save Student Fees
     * 
     * @param Array $data
     * @return model
     */
    public function SaveStudentFees($data, $id = null) {
        $model = $this;

        if ($id) {
            $model = $this->find($id);
        }

        $model->fill($data);
        $model->save();
        return $model;
    }

}
