<?php

namespace App\Http\Controllers\Common\api;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Fee;
use App\Models\StudentFees;
use App\Helpers\Helper;

class SchoolController extends BaseController {

    public function getClasses() {
        return response()->json(Helper::getClasses());
    }

    public function getAcademicYears() {
        return response()->json(Helper::getAcademicYears());
    }

    public function getFeeStructure($student_id, $id, $academic_year) {

        $fee_details = Helper::getStudentFeeDetails($student_id, $id, $academic_year);

        if (isset($fee_details['status']) && $fee_details['status'] == 0) {
            $response = ['status' => 0, 'message' => 'No data found for this academic year.'];
        }

        $response = ['status' => 1, 'fee_structure' => $fee_details['fee_structure'], 'topay' => $fee_details['total_pending_fee']];
        return response()->json($response);
    }

}
