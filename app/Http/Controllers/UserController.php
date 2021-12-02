<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\UserHobbie;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userAdd(Request $request)
    {
        $user= Auth::user();
        $hobbies=$request->hobbies;
        foreach($hobbies as $hobbie)
        {
            UserHobbie::create([
                'user_id'=>$user->id,
                 'hobbie_id'=>$hobbie,
            ]);
        }
        return response()->json('Successfully Inserted');
        
    }

    public function userUpdate(Request $request)
    {
        $user= Auth::user();
        UserHobbie::where('user_id', $user->id)->delete();
        
        $hobbies=$request->hobbies;
        foreach($hobbies as $hobbie)
        {
            UserHobbie::create([
                'user_id'=>$user->id,
                'hobbie_id'=>$hobbie,
            ]);
        }
        return response()->json('Successfully Updated');
         }

   

}
