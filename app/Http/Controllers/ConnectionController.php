<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Models\Connection;
use App\Transformers\ConnectionTransformer;
class ConnectionController extends Controller
{
    public function getConnections(Request $request)
    {
        try {
            $connections = Connection::where('user_id',$request->id)->get();
        
            return fractal()->collection($connections)->transformWith(new ConnectionTransformer())->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
       
       }
    }

}
