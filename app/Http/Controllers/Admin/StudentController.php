<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentClassDetail;
use App\Models\StudentFees;
use App\Helpers\Helper;
use App\Models\User;
use Redirect;

class StudentController extends Controller
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
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request  $request)
    {
        $student = new Student();
        $by = $request->by;
        $sort = $request->sort;
        $data = $student->GetStudentList($by, $sort);
        return view('student.list', ['response' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Array
     */
    public function store(Request $request)
    {
        try {
            // Validations
            $validation = Validator::make($request->all(), [
                'email' => 'required|email|unique:users|max:255',
                'username' => 'required',
                'phone' => 'required|numeric|unique:users,phonenumber',
                'password' => 'sometimes|required|min:6|required_with:reenter_password|same:reenter_password',
                'reenter_password' => 'min:6',
                'state' => 'required',
                'city' => 'required',
            ]);

            if ($validation->fails()) {
                $errors = $validation->messages()->get('*');
                foreach ($errors as $key => $val) { 
                    return ['status' => 'error', 'message' => $val, 'data' => ['for' => $key]];
                }
            }

            // Add user details
            $user = new User();
            $user_data['user_type'] = '1';
            $user_data['name'] = $request->username;
            $user_data['gender'] = $request->gender;
            $user_data['email'] = $request->email;
            $user_data['phonenumber'] = $request->phone;
            $user_data['password'] = $request->password;
            $user_data['image'] = '';
            $user_data['dob'] = date('Y-m-d', strtotime($request->dob));
            $user_data['address'] = $request->address;
            $user_data['state_id'] = $request->state;
            $user_data['city_id'] = $request->city;
            $user_data['date_of_join'] = date('Y-m-d', strtotime($request->doj));
            $user_data['status'] = 1;
            $user = $user->SaveUser($user_data);

            // Add student details
            $student = new Student();
            $student_data['user_id'] = $user->id;
            $student_data['academic_year_id'] = $request->academic_year_id;
            $student_data['admission_class_id'] = $request->class_id;
            $student_data['caste'] = $request->caste;
            $student_data['father_name'] = $request->father_name;
            $student_data['mother_name'] = $request->mother_name;
            $student_data['current_address'] = $request->current_address;
            $student_data['reg_number'] = Helper::getRegistrationCode($user->id);
            $student = $student->SaveStudent($student_data);

            // Add student class details
            $studentFees = new StudentClassDetail();
            $classData['student_id'] = $student->id;
            $classData['class_id'] = $request->class_id;
            $classData['academic_year_id'] = $request->academic_year_id;
            $classData['fee_id'] = $request->academic_year_id;
            $studentFees->SaveStudentClass($classData);

            $studentFees = new StudentFees();
            $feeData['student_id'] = $student->id;
            $feeData['academic_year_id'] = $request->academic_year_id;
            $studentFees->SaveStudentFees($feeData);
            

            return ['status' => 'success', 'message' => "Student registered successfully."];
         
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
        //return redirect('/student-list')->with('msg', 'You have successfully register a student.');
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
                return view('student.edit',['student_id' => $id,'data' => $data]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Array
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
            $student_data['mother_name'] = $request->mother_name;
            $student_data['father_name'] = $request->father_name;
            $student_data['caste'] = $request->caste;
            $student_data['current_address'] = $request->current_address;
            $student_data['reg_number'] = Helper::getRegistrationCode($user->id);
            $student = $student->SaveStudent($student_data,$data['id']);

            return ['status' => 'success', 'message' => "Student record updated successfully."];            
        }
        else
        {
            return ['status' => 'error', 'message' => 'Some error occured!'];
        }
    }

    /*
     * Remove specified resource from storage.
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
