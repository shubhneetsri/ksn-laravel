<?php

namespace App\Http\Controllers\Common\api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use SwooleTW\Http\Websocket\Facades\Websocket;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class ResourceController extends Controller
{

     /**
     * Get countries
     * @return void
     */
    public function GetCountries(){

        $Country = new Country();
        $countries = $Country->GetCountries();

        return response()->json($countries);

    }

    /**
     * Get states
     * @param Request $request
     * @return void
     */
    public function GetStates(Request $request){

        // Initialize array
        $states = array();

        // Fetch states if country id found
        if(isset($request->country_id)){

            // Set ID
            $country_id = $request->country_id;

            $State = new State();
            $states = $State->GetStates($country_id);
        }

        return response()->json($states);

    }

    /**
     * Get cities
     * @param Request $request
     * @return void
     */
    public function GetCities(Request $request){

        // Initialize array
        $cities = array();

        // Fetch cities if state id found
        if(isset($request->state_id)){

            // Set ID
            $state_id = $request->state_id;

            $City = new City();
            $cities = $City->GetCities($state_id);
        
        }
        
        return response()->json($cities);

    }
}