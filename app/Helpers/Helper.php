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

    public static function getRegistrationCode($id){
        return 'KSN_'.mt_rand(10,99).date('Y').$id;
    }
}
