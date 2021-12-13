<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Transformers\MemberTransformer;
class MemberController extends Controller
{
    public function getMembers(Request $request)
    {
        try {
            $members = Member::where('user_id',$request->id)->get();
        
            return fractal()->collection($members)->transformWith(new MemberTransformer())->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
       
       }
    }
}
