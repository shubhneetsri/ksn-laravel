<?php

namespace App\Http\Controllers\Book\api;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class bookController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function add(Request $request){
        
        $returnArr['param'] = "test";
        $returnArr['error'] = "The Line number is : ". __line__;
        $returnArr['status'] = "The directory is : ". __dir__;

        return response()->json($request);
    }
}