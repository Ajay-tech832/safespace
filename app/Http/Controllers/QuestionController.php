<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use App\Transformers\QuestionTransformer;
use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getQuestions(){
        $questions = Question::all();
        
        return fractal()->collection($questions)->transformWith(new QuestionTransformer)->toArray();

    }

    public function addQuestions(QuestionRequest $request)
    {
      
        $user = new Question;
        $user->question = $request->input('question');
        $user->save();  

        return response()->json(['message'=>'Question Add Succssfully'],200);
    }
    
}
