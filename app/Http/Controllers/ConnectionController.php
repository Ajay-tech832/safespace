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
        foreach ($connections as $connection) {

        }
        return fractal()->item($connection)->transformWith(new ConnectionTransformer())->toArray();
    }
}
