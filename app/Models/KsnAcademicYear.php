<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KsnAcademicYear extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ksn_academic_years';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'academic_year', 'created_at', 'updated_at'
    ];
}
