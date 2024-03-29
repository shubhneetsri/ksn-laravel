<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models\Student\Student;
use App\Models\Student\StudentClassDetail;
use App\Models\Student\StudentFees;
use Illuminate\Http\Response;
use Cookie;
use App\Helpers\Helper;
use Session;
use Redirect;
use Auth;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            dd($request);
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

        
            if ($validation->fails())
            {
                $errors = $validation->messages()->get('*');
                foreach($errors as $key=>$val){
                    Session::flash('message', $key); 
                    Session::flash('alert-class', 'alert-danger'); 
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
            $student_data['caste'] = $request->caste;
            $student_data['current_address'] = $request->current_address;
            $student_data['reg_number'] = Helper::getRegistrationCode($user->id);
            $student = $student->SaveStudent($student_data);

            // Add student class details
            $studentFees = new StudentFees();
            $feeData['student_id'] = $student->id;
            $feeData['academic_year_id'] = $request->class_id;
            $feeData['fee_id'] = $request->academic_year_id;
            $studentFees->SaveStudentClass($feeData);
        
            echo "Sucecss";
        } catch (\Exception $e) {
            $output['errors'][] = ['invalid' => 1, 'for' => 'form_error' , 'message' => 'Something went wrong!'];

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

    private function setCookie($key,$values) {

        $minutes = 2;
        echo "test";
        $response = new Response('Hello World');

//Call the withCookie() method with the response method
return $response->withCookie(cookie($key, $values, $minutes));

        //Call the withCookie() method with the response method
        //return Cookie::queue($key, $values, $minutes);

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

        //dd($request->session()->get('10.10.140.222'));

        $id =   Auth::user()->id;
        $userModel = new User();
        $data = $userModel->GetUser($id);

        if($data['access_token']){
            
            $url = 'http://10.10.15.19/api/test.php';
            $fields = array(
                'access_token' => $data['access_token'],
                'secret' => 1234,
            );

            //url-ify the data for the POST
            $fields_string = '';
            foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            rtrim($fields_string, '&');


            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1); 
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            // return the transfer as a string, also with setopt()
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

            //execute post
            $result = curl_exec($ch);
            $info = curl_getinfo($ch);

            $result_arr = json_decode($result,true);
            sleep(5);
            

            if($result_arr['status'] == 'error'){

                echo "<pre>";print_r($result_arr);echo "</pre>";

                $url = 'http://10.10.15.19/api/authorization_two.php.php';
                $fields = array(
                    'lname' => urlencode('test'),
                    'fname' => urlencode('test'),
                    'refresh_token_request' => 1,
                    'access_token' => $data['access_token'],
                    'refresh_token_request' => $data['refresh_access_token'],
                    'secret' => urlencode(1234),
                    'email' => urlencode('test'),
                );

                //url-ify the data for the POST
                $fields_string = '';
                foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                rtrim($fields_string, '&');


                //open connection
                $ch = curl_init();

                //set the url, number of POST vars, POST data
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
                curl_setopt($ch,CURLOPT_POST, count($fields));
                curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                // return the transfer as a string, also with setopt()
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);

                //execute post
                $result = curl_exec($ch);

                $result_arr = json_decode($result,true);
                

                if (!curl_errno($ch)) {
                    $info = curl_getinfo($ch);
                    echo 'Took ', $info['total_time'], ' seconds to send a request to ', $info['url'], "\n";
                  }
                  curl_close($ch);
                dd($result);
                
                // Add user details
                $user = new User();
                $user_data['access_token'] = $result_arr['access_token'];
                $user_data['refresh_access_token'] = $result_arr['refresh_access_token'];
                $user = $user->SaveUser($user_data,$id);
                

            }

        }else{

            $url = 'http://10.10.15.19/api/authorization_two.php.php';
            $fields = array(
                'lname' => urlencode('test'),
                'fname' => urlencode('test'),
                'secret' => urlencode(1234),
                'email' => urlencode('test'),
            );

            //url-ify the data for the POST
            $fields_string = '';
            foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            rtrim($fields_string, '&');


            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
            curl_setopt($ch,CURLOPT_POST, count($fields));
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            // return the transfer as a string, also with setopt()
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            //execute post
            $result = curl_exec($ch);

            $result_arr = json_decode($result,true);
            
            // Add user details
            $user = new User();
            $user_data['access_token'] = $result_arr['access_token'];
            $user_data['refresh_access_token'] = $result_arr['refresh_access_token'];
            $user = $user->SaveUser($user_data,$id);
            dd($user);

        }





        $student = new Student();
        $by = $request->by;
        $sort = $request->sort;
        $data = $student->GetStudentList($by,$sort);
//dd(Auth::user()->getAllPermissions());
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

            // Git Changes By Me
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