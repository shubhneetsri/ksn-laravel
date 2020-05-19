<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models\Student\Student;
use App\Models\Student\StudentClassDetail;
use App\Helpers\Helper;

class StudentController extends Controller
{
     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('student.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validations
        Validator::make($request->all(), [
            'email' => 'required|email|unique:users|max:255',
            'username' => 'required',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|min:6|required_with:reenter_password|same:reenter_password',
            'reenter_password' => 'min:6',
            'state' => 'required',
            'city' => 'required',
        ]);

        // Add user details
        $user = new User();
        $user_data['user_type'] = '1';
        $user_data['name'] = $request->username;
        $user_data['gender'] = $request->gender;
        $user_data['email'] = $request->email;
        $user_data['phonenumber'] = $request->phone;
        $user_data['password'] = $request->password;
        $user_data['image'] = '';
        $user_data['dob'] = date('Y-m-d',strtotime($request->dob));
        $user_data['address'] = $request->address;
        $user_data['state_id'] = $request->state;
        $user_data['city_id'] = $request->city;
        $user_data['status'] = 1;
        $user = $user->SaveUser($user_data);

        // Add student details
        $student = new Student();
        $student_data['user_id'] = $user->id;
        $student_data['academic_year_id'] = $request->academic_year_id;
        $student_data['admission_class_id'] = $request->class_id;
        $student_data['reg_number'] = Helper::getRegistrationCode($user->id);
        $student = $student->SaveStudent($student_data);

        // Add student class details
        $studentDetail = new StudentClassDetail();
        $detailData['student_id'] = $student->id;
        $detailData['class_id'] = $request->class_id;
        $detailData['academic_year_id'] = $request->academic_year_id;
        $studentDetail->SaveStudentClass($detailData);

        return redirect('/student-list')->with('msg', 'You have successfully register a student.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $student = new Student();
        $data = $student->GetStudentList();

        return view('student.list',['response' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}