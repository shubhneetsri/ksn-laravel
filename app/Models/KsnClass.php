<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KsnClass extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ksn_classes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'roman_name', 'number_name', 'teacher_id', 'created_at', 'updated_at'
    ];
}
