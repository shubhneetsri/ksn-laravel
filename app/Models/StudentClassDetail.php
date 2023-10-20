<?php

namespace App\Models;

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
        'id', 'student_id', 'class_id', 'academic_year_id', 'status', 'created_at', 'updated_at'
    ];

    /**
     * Get User details
     */
    public function detail()
    {
        return $this->belongsTo('App\Models\KsnClass','class_id');
    }

     /**
     * Save User
     * @param Array $data
     * @return model
     */
    public function SaveStudentClass($data)
    {
        $this->fill($data);
        $this->save();
        return $this;

    }

    /**
     * Delete Student Class
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
