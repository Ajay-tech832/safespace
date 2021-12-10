<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use App\Transformers\AnswerTransformer;
use App\Http\Requests\AnswerRequest;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
   public function getAnswers()
   {
       $answers = Answer::all();

       return fractal()->collection($answers)->transformWith(new AnswerTransformer)->toArray();
   }

   public function addAnswers(AnswerRequest $request)
   {
       $answers = new Answer;
       $answers->answer = $request->input('answer');
       $answers->question_id = $request->input('question_id');
       $answers->user_id  = Auth::id();
       $answers->save();
      
       return response()->json(['message'=>'Answer Added Succssfully'],200);
   }
}
