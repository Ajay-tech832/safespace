<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use App\Transformers\QuestionTransformer;
use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getQuestions(){
        try{
            $questions = Question::all();
        
            return fractal()->collection($questions)->transformWith(new QuestionTransformer)->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }

}

    public function addQuestions(QuestionRequest $request)
    {
      try{
        $user = new Question;
        $user->question = $request->input('question');
        $user->save();  

        return response()->json(['message'=>'Question Add Succssfully'],200);
      }catch (Exception $e) {
        return response()->json(['message' => $e->getMessage()],  500);
        
     } 
    
  }
}
