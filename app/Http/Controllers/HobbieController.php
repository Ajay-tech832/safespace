<?php

namespace App\Http\Controllers;

use App\Models\Hobbie;
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
        $hobbies = Hobbie::all();
        return response()->json($hobbies,200);
    }

   
}
