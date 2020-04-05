<?php

namespace App\Http\Controllers\Student\api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Student\Student;
use App\Models\Student\StudentClassDetail;
use App\Helpers\Helper;

class registerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function add(Request $request){

        return response()->json(Helper::getList());
        
        $student = new Student();

        $data['class_id'] = $request->class_id;
        $data['reg_number'] = NULL;
        $data['academic_year_id'] = $request->academic_year;
        $data['name'] = $request->name;
        $data['gender'] = $request->gender;
        $data['father_name'] = $request->father_name;
        $data['mother_name'] = $request->mother_name;
        $data['dob'] = date('Y-m-d',strtotime($request->dob));
        $data['status'] = $request->status;
        $data['image'] = $request->image;
        $data['address'] = $request->address;

        $student->fill($data);
        $student->save();

        $student->reg_number = 'KSN_'.mt_rand(10,99).date('Y').$student->id;

        $student->save();

        $studentDetail = new StudentClassDetail();
        $detailData['student_id'] = $student->id;
        $detailData['class_id'] = $request->class_id;
        $detailData['academic_year_id'] = $request->academic_year;

        $studentDetail->fill($detailData);
        $studentDetail->save();

        //$data['class_id'] = $request->check;
        
        return response()->json($request);
    }
}