<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Connection;
use App\Transformers\ConnectionTransformer;
class ConnectionController extends Controller
{
    public function getConnections(Request $request)
    {
        $connections = Connection::where('user_id',$request->id)->get();
        
        return fractal()->collection($connections)->transformWith(new ConnectionTransformer())->toArray();
    }
}
