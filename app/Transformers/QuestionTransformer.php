<?php

namespace App\Transformers;

use App\Models\Question;
use League\Fractal\TransformerAbstract;

class QuestionTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(Question $data): array
    {
        return [
             "question" => $data->question,
             
        ];
    }
}