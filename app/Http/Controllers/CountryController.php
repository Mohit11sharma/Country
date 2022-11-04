<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $country = Country::where('parent_id', 0)->get();
        return view('allcountry', compact('country'));
    }

    public function store(Request $request)
    {

        $country = new Country();

        if(isset($request->type) && $request->type == 'Country')
        {
            $country->parent_id = 0;
        }

        if(isset($request->type) && $request->type == 'States')
        {
            $country->parent_id = $request->country;
        }

        if(isset($request->type) && $request->type == 'Cities')
        {
            $country->parent_id = $request->state;
        }

        $country->name = $request->name;
        $country->status = $request->status;
        $country->save();
        return redirect()->back();
    }

    public function ajax_city(Request $request)
        {
          
            $html = '<option value="">Select State</option>';
            $cities = Country::where('parent_id', $request->substate)->get();
            
            foreach($cities as $city){
              
                $html .= '<option value="'.$city->id.'">'.$city->name.'</option>';
            }
            return $html;    
        }
}
