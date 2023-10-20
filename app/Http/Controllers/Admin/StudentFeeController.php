<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models\Student;
use App\Models\StudentFees;
use App\Models\StudentClassDetail;
use App\Models\StudentFeeTransaction;
use App\Models\Fee;
use App\Helpers\Helper;
use Redirect;
use Session;

class StudentFeeController extends Controller {
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * /
      public function index() {
      return view('student.add');
      }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * /
      public function store(Request $request) {
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
      } */

    /**
     * Display the specified resource.
     * @param $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id) {

        $data = [];
        $student_fee_data = [];
        $fee_details = [];
        $key_value_array = [];
        $total_pending_fee = 0;
        $is_payment_pending = false;

        // If resource id exists
        if ($id) {

            $student = new Student();
            $data = $student->GetStudent($id);

            if (isset($data['class']['academic_year_id'])) {

                $studentFees = new StudentFees();
                $student_fee_data = $studentFees->getStudentFeeDetail($id, $data['class']['academic_year_id']);
            }

            // If resource exists
            if (isset($data['id'])) {

                $feeDetails = new Fee();
                $feeStructures = $feeDetails->GetFees();

                if (!empty($student_fee_data)) {
                    $key_value_array = Helper::fee_structure_fields();
                    $fee_details = Helper::getStudentFeeDetails($id, $student_fee_data['fee_id'], $data['class']['academic_year_id'], true);
                }

                if ($fee_details['fee_structure'] == null || (isset($fee_details['total_pending_fee']) && $fee_details['total_pending_fee'] > 0)) {
                    $is_payment_pending = true;
                }

                return view('student_fees.edit', ['student_id' => $id, 'data' => $data, 'feeStructures' => $feeStructures,
                    'student_fee_details' => $fee_details, 'key_value_array' => $key_value_array, "is_payment_pending" => $is_payment_pending]);
            } else {
                return redirect('/student-list');
            }
        } else {
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
    public function show(Request $request) {
        $student_fees = new StudentFees();
        $by = $request->by;
        $sort = $request->sort;
        $data = $student_fees->GetStudentFeeList($by, $sort);

        return view('student_fees.list', ['response' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        // Validations
        Validator::make($request->all(), [
            'add_fee_amount' => 'required',
            'recieved_on' => 'required',
        ]);

        if ($id) {
            $student = new Student();
            $data = $student->GetStudent($id);

            if ($request->get('add_fee_amount') < 1) {
                return response()->json(['status' => 'error', 'message' => 'You must enter valid amount detail.']);
            }

            if (empty($data)) {
                return response()->json(['status' => 'error', 'message' => 'This student is not found.']);
            }

            $fee_details = Helper::getStudentFeeDetails($id, $request->get('fee_id'), $request->get('academic_year_id'), true);

            if (isset($fee_details['ststus']) && $fee_details['ststus'] == 0) {
                return [];
            }

            $key_value_array = Helper::fee_structure_fields();
            $debit_amount = $request->get('add_fee_amount');
            foreach ($fee_details['pending_fee_details'] as $month => $pending_amount) {
                if ($debit_amount > 0) { // $debit_amount >= $balence_to_pay[$key_value_array[$month]]
                    if ($pending_amount < $fee_details['student_fee_stack'][$month]) {
                        $balence_to_pay = $pending_amount;
                    } else {
                        $balence_to_pay = $pending_amount; //(int) ($pending_amount - $fee_details['student_fee_stack'][$month]);
                    }

                    if ($debit_amount < $balence_to_pay) {
                        $amt = $debit_amount;
                        $debit_amount = 0;
                    } else {
                        $debit_amount = $debit_amount - $balence_to_pay;
                        $amt = $balence_to_pay;
                    }

                    if ($amt > 0) {
                        $studentFeeTransaction = new StudentFeeTransaction();
                        $transactionData['student_fee_id'] = $fee_details['student_fee_id'];
                        $transactionData['student_id'] = $id;
                        $transactionData['academic_year_id'] = $request->get('academic_year_id');
                        $transactionData['method'] = 'COD';
                        $transactionData['type'] = Helper::get_fee_transaction_type($month);
                        $transactionData['fee'] = $amt;
                        $transactionData['recieved_on'] = $request->get('recieved_on');
                        $transactionData['given_by'] = 'parent';
                        $transactionData['recieved_by'] = 'admin';
                        $studentFeeTransaction->SaveTransaction($transactionData);
                        $debited_amount[$key_value_array[$month]] = $fee_details['student_fee_stack'][$month] + $amt;
                    }
                }
            }

            //dd($debited_amount);

            $studentFees = new StudentFees();
            $debited_amount['student_id'] = $id;
            $debited_amount['academic_year_id'] = $request->get('academic_year_id');
            $debited_amount['fee_id'] = $request->get('fee_id');
            $studentFees->SaveStudentFees($debited_amount, $fee_details['student_fee_id']);

            $message = $data['user']['name'] . ' Fees is submitted successfully. The total paid amount is ' . $request->get('add_fee_amount') . ' Rs.';
            if ($debit_amount > 0) {
                $message .= 'The total paid amount is ' . ($request->get('add_fee_amount') - $debit_amount) . ' and the unpaid amount is ' . $debit_amount;
            }

            Session::flash('alert-success', $message);

            return response()->json(['status' => 1, 'message' => $message]);
        }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id) {
        $student = new Student();
        $data = $student->GetStudent($id);

        // Delete student when refrences defined
        $student_destroy = $student->Remove($data['id']);

        if ($student_destroy) {
            return Redirect::back()->with('msg', 'Record is deleted successfully.');
        } else {
            return Redirect::back()->with('error_msg', 'Record not remove!');
        }


        /*         * Delete when refrences are not defined  

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
          } */
    }
}
