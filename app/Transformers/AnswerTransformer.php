<?php

namespace App\Transformers;

use App\Models\Answer;
use League\Fractal\TransformerAbstract;

class AnswerTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(Answer $data): array
    {
        return [
             "answer" => $data->answer,
             
        ];
    }
}