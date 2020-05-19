<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'state_id'
    ];

    /**
     * Get cities
     * @param $data
     * @return Array
     */
    public function GetCities($state_id){

        $states = array();

        if(isset($state_id)){
            $states = $this->where('state_id',$state_id)->get()->toArray(); // fetch the state's cities
        }

        return $states;
    }

}
