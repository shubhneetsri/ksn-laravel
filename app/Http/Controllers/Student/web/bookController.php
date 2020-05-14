<?php

namespace App\Http\Controllers\Book\web;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class bookController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function add(){
        echo "test";
        echo "The Line number is : ". __line__;
        echo "The directory is : ". __dir__; 
    }
}