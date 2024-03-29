<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models\Student\Student;
use App\Models\Student\StudentFees;
use App\Models\Student\StudentClassDetail;
use App\Helpers\Helper;
use Session;
use Redirect;

class StudentFeeController extends Controller
{
     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('student.add');
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
            'password' => 'sometimes|required|min:6|required_with:reenter_password|same:reenter_password',
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
        $user_data['date_of_join'] = date('Y-m-d',strtotime($request->doj));
        $user_data['status'] = 1;
        $user = $user->SaveUser($user_data);

        // Add student details
        $student = new Student();
        $student_data['user_id'] = $user->id;
        $student_data['academic_year_id'] = $request->academic_year_id;
        $student_data['admission_class_id'] = $request->class_id;
        $student_data['mother_name'] = $request->mother_name;
        $student_data['father_name'] = $request->father_name;
        $student_data['caste'] = $request->caste;
        $student_data['current_address'] = $request->current_address;
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
     * @param $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $data = [];
        
        // If resource id exists
        if($id)
        {
        
            $student = new Student();
            $data = $student->GetStudent($id);

            // If resource exists
            if(isset($data['id']))
            {
                return view('student.edit',['data' => $data]);
            }
            else
            {
                return redirect('/student-list');
            }

        }else{
            return redirect('/student-list');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request  $request)
    {
        $student_fees = new StudentFees();
        $by = $request->by;
        $sort = $request->sort;
        $data = $student_fees->GetStudentFeeList($by,$sort);

        return view('student_fees.list',['response' => $data]);
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
        // Validations
        Validator::make($request->all(), [
            'email' => 'required|email|unique:users|max:255',
            'username' => 'required',
            'phone' => 'required|numeric|unique:users',
            'password' => 'sometimes|required|min:6|required_with:reenter_password|same:reenter_password',
            'reenter_password' => 'min:6',
            'state' => 'required',
            'city' => 'required',
        ]);
        
        if($id)
        {

            $student = new Student();
            $data = $student->GetStudent($id);
            
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
            $user_data['date_of_join'] = date('Y-m-d',strtotime($request->doj));
            $user_data['status'] = 1;
            $user = $user->SaveUser($user_data,$data['user_id']);

            // Add student details
            $student = new Student();
            $student_data['academic_year_id'] = $request->academic_year_id;
            $student_data['admission_class_id'] = $request->class_id;
            $student_data['mother_name'] = $request->mother_name;
            $student_data['father_name'] = $request->father_name;
            $student_data['caste'] = $request->caste;
            $student_data['current_address'] = $request->current_address;
            $student_data['reg_number'] = Helper::getRegistrationCode($user->id);
            $student = $student->SaveStudent($student_data,$data['id']);

            /* Add student class details
            $studentDetail = new StudentClassDetail();
            $detailData['student_id'] = $student->id;
            $detailData['class_id'] = $request->class_id;
            $detailData['academic_year_id'] = $request->academic_year_id;
            $studentDetail->SaveStudentClass($detailData);*/

            return redirect('/student-list')->with('msg', 'You have successfully register a student.');
            
        }
        else
        {
            return Redirect::back()->with('error_msg', 'Some error occured!');
        }
    }
    
    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = new Student();
        $data = $student->GetStudent($id);
       
        // Delete student when refrences defined
        $student_destroy = $student->Remove($data['id']);

        if($student_destroy)
        {
            return Redirect::back()->with('msg', 'Record is deleted successfully.');
        }
        else
        {
            return Redirect::back()->with('error_msg', 'Record not remove!');
        }
        

        /**Delete when refrences are not defined  
        
        // If resource exists
        if($data)
        {
            $studentDetail = new StudentClassDetail();
            $class_destroy = $studentDetail->Remove($data['class']['id']);
       
            // If class is deleted
            if($class_destroy)
            {
                $user = new User();
                $user_destroy = $user->Remove($data['user']['id']);

                // If user deleted
                if($user_destroy)
                {
                    // Delete student
                    $student_destroy = $student->Remove($data['id']);
                    return Redirect::back()->with('msg', 'Record is deleted successfully.');
                }
                else
                {
                    return Redirect::back()->with('error_msg', 'User is not removed!');
                }

            }
            else
            {
                return Redirect::back()->with('error_msg', 'Class is not removed!');
            }

        }else{
            return Redirect::back()->with('error_msg', 'Record not found to remove!');
        }*/
    }
}