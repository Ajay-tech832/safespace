<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Transformers\ChatTransformer;
use App\Models\Chat;

class ChatController extends Controller
{
    public function getChats(){
        try{
            $chats = Chat::all();
            foreach($chats as $chat){
    
            }
            return fractal()->item($chat)->transformWith(new ChatTransformer())->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        

        }
    }

}
