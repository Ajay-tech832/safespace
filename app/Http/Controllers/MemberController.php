<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Transformers\MemberTransformer;
class MemberController extends Controller
{
    public function getMembers(Request $request)
    {
        $members = Member::where('user_id',$request->id)->get();
        // foreach ($members as $member) {

        // }
        return fractal()->collection($members)->transformWith(new MemberTransformer())->toArray();
    }
}
