<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.manage');
    }

    /**
     * 
     */
    public function save(Request $request){

        dd($request);
        /*$student = new Student();

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
        
        return response()->json($request);*/

    }

    
}