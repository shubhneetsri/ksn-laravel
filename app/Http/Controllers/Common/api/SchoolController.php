<?php

namespace App\Http\Controllers\Common\api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Student\Student;
use App\Models\Student\StudentClassDetail;
use App\Helpers\Helper;

class SchoolController extends BaseController
{
    public function getClasses(){
        return response()->json(Helper::getClasses());
    }

    public function getAcademicYears(){
        return response()->json(Helper::getAcademicYears());
    }
}
