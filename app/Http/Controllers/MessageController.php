<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Transformers\MessageTransformer;

class MessageController extends Controller
{
    public function getMessages(Request $request)
    {
        try {
            $messages = Message::where('user_id',$request->id)->get();
        
            return fractal()->collection($messages)->transformWith(new MessageTransformer())->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        
        }
    }
}
