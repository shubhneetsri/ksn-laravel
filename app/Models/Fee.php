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
     * Get states
     * @param $data
     * @return Array
     */
    public function GetFees($academic_year_id){
        
        $fees_list = array();

        if(isset($academic_year_id)){
            $fees_list = $this->where('country_id',$academic_year_id)->first()->toArray(); // fetch the US states
        }
        
        return $states;
    }

}
