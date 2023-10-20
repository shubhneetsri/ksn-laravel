<?php

namespace App\Helpers;

use App\Models\KsnClass;
use App\Models\Fee;
use App\Models\StudentFees;
use App\Models\KsnAcademicYear;

class Helper {

    public static function getClasses() {
        return KsnClass::get();
    }

    public static function getAcademicYears() {
        return KsnAcademicYear::get();
    }

    public static function getClassNameByID($id) {
        return KsnClass::where('id', $id)->first()->name;
    }

    public static function getAcademicYearByID($id) {
        return KsnAcademicYear::where('id', $id)->first()->academic_year;
    }

    public static function getRegistrationCode($id) {
        return 'KSN_' . mt_rand(10, 99) . date('Y') . $id;
    }

    public static function fee_structure_fields() {
        return [
            'admission_fee' => 'admission_fee',
            'development_fee' => 'development_fee',
            'other_fee' => 'other_fee',
            '1' => 'april',
            '2' => 'may',
            '3' => 'june',
            '4' => 'july',
            '5' => 'aug',
            '6' => 'sept',
            '7' => 'oct',
            '8' => 'nov',
            '9' => 'dec',
            '10' => 'jan',
            '11' => 'feb',
            '12' => 'march',
        ];
    }

    public static function get_fee_transaction_type($val) {
        if ($val == 'admission_fee') {
            return 'ADD';
        } else if ($val == 'development_fee') {
            return 'DEV';
        } else if ($val == 'other_fee') {
            return 'OTHER';
        } else if (is_int($val)) {
            return 'MONTHLY';
        }
    }

    /**
     * Get Student fee details and structure
     * 
     * @param type $student_id
     * @param type $id
     * @param type $academic_year
     */
    public static function getStudentFeeDetails($student_id, $id, $academic_year_id, $all_months = false) {

        $fee_details = Fee::where('id', $id)->first();
        $student_fee_data = StudentFees::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->first();

        if (empty($student_fee_data)) {
            return ['status' => 0, 'message' => 'No data found for this academic year.'];
        }

        $fee_array = array();
        foreach (self::fee_structure_fields() as $key => $value) {
            if ($fee_details) {
                $fee_array[$key] = is_int($key) ? $fee_details->monthly_fee : $fee_details->$value;
            } else {
                $fee_array[$key] = 0;
            }
        }

        $student_fee_array = array();
        foreach (self::fee_structure_fields() as $key => $value) {
            $student_fee_array[$key] = $student_fee_data->$value;
        }

        $current_month = (int) date('m', time());
        $total_pending_fee = 0;
        $pending_fee_details = [];
        foreach ($student_fee_array as $month => $paid_fee) {
            if ($all_months == false && $month == $current_month) {
                break;
            }

            $pending_fee_details[$month] = (int) $fee_array[$month] - (int) $paid_fee;
            $total_pending_fee = $total_pending_fee + ((int) $fee_array[$month] - (int) $paid_fee);
        }

        return ['status' => 1, 'student_fee_id' => $student_fee_data->id, 'fee_structure' => $fee_details, 'student_fee_stack' => $student_fee_array, 'pending_fee_details' => $pending_fee_details, 'total_pending_fee' => $total_pending_fee];
    }
}
