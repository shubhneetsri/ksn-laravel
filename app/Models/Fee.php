<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Fee extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ksn_fee_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'academic_year_id', 'admission_fee', 'development_fee', 'other', 'monthly_fee', 'created_at', 'updated_at'
    ];

    /**
     * Get Academic Year
     */
    public function academic_year(){
        return $this->belongsTo('App\Models\KsnAcademicYear','academic_year_id');
    }

    /**
     * Get Fees Structures
     * @param $data
     * @return Array
     */
    public function GetFees($academic_year_id = null){
        
        if(isset($academic_year_id)){
            $fees_list = $this->with(['academic_year'])->where('academic_year_id',$academic_year_id)->get()->toArray(); // fetch the US states
        }else{
            $fees_list = $this->with(['academic_year'])->get()->toArray(); // fetch the US states
        }
        
        return $fees_list;
    }

}
