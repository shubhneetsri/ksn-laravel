<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class State extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'states';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'country_id'
    ];

    /**
     * Get states
     * @param $data
     * @return Array
     */
    public function GetStates($country_id){
        
        $states = array();

        if(isset($country_id)){
            $states = State::where('country_id',$country_id)->get()->toArray(); // fetch the US states
        }
        
        return $states;
    }

}
