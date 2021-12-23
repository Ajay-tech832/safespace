<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Country;
use App\Transformers\CountryTransformer;
use App\Http\Requests\CountryRequest;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getCountries(Request $request)
    {
        try {
            $countrys= Country::where([
                ['name', '!=', Null],
                [function ($query) use ($request){
                if(($name = $request->name)){
                    $query->orWhere('name','LIKE','%' . $name . '%');
                } 
                }]
            ])->orderBy('id','ASC')->get();

            return fractal()->collection($countrys)->transformWith(new CountryTransformer)->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
    }

    public function addCountries(CountryRequest $request)
    {
        try {
            $country = new Country;
            $country->code = $request->input('code');
            $country->name = $request->input('name');
            $country->save();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
       
    }
}
