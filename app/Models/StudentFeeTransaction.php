<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFeeTransaction extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ksn_student_fee_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'student_fee_id', 'student_id', 'academic_year_id', 'month', 'method', 'type', 'fee', 'late_fee', 'given_by', 'recieved_by', 'recieved_on', 'created_at', 'updated_at'
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
    public function SaveTransaction($data)
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
