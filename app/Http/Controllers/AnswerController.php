<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Transformers\AnswerTransformer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
   public function getAnswers()
   {
       $answers = Answer::all();

       return fractal()->collection($answers)->transformWith(new AnswerTransformer)->toArray();
   }
}
