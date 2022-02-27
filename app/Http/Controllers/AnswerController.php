<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use App\Transformers\AnswerTransformer;
use App\Http\Requests\AnswerRequest;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
   public function getAnswers($id)
   {
       try {
        if(!$id){
            $data = Answer::all();
            return fractal()->collection($data)->transformWith(new AnswerTransformer)->toArray();
        }else{
           $data = Answer::with('question')->where('question_id',$id)->get();
           return fractal()->collection($data)->transformWith(new AnswerTransformer)->toArray();
        }   
        
       }catch (Exception $e) {
        return response()->json(['message' => $e->getMessage()],  500);
       }
   }

   public function addAnswers(AnswerRequest $request)
   {
       try {
        $answers = new Answer;
        $answers->answer = $request->input('answer');
        $answers->question_id = $request->input('question_id');
        $answers->user_id  = Auth::id();
        $answers->save();
       
        return response()->json(['message'=>'Answer Added Succssfully'],200);
       }catch (Exception $e) {
        return response()->json(['message' => $e->getMessage()],  500);
    }
      
   }
}
