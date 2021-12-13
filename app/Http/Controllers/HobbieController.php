<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Hobbie;
use App\Transformers\HobbiesTransformer;
use Illuminate\Http\Request;

class HobbieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHobbies()
    {
        try {
            $hobbies = Hobbie::all();
       
            return fractal()->collection($hobbies)->transformWith(new HobbiesTransformer())->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        
       
       }    
    }

}