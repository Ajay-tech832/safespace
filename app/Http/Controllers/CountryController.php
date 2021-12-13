<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Country;
use App\Transformers\CountryTransformer;
use App\Http\Requests\CountryRequest;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getCountries()
    {
        try {
            $countrys= Country::all();

            return fractal()->collection($countrys)->transformWith(new CountryTransformer)->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
    }

    public function addCountries(CountryRequest $request)
    {
       $country = new Country;
       $country->code = $request->input('code');
       $country->name = $request->input('name');
       $country->save();
    }
}
