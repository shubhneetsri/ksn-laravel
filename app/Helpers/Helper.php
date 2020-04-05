<?php

namespace App\Helpers;
use App\Models\KsnClass;
use App\Models\KsnnAcademicYear;

class Helper
{
    public static function getClasses(){
        return KsnClass::get();
    }

    public static function getAcademicYears(){
        return KsnnAcademicYear::get();
    }
}
