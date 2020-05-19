<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Country extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'code', 'name', 'phonecode'
    ];

    /**
     * Get states
     * @return Array
     */
    public function GetCountries(){
        return Country::get()->toArray(); // fetch the US states
    }

}
