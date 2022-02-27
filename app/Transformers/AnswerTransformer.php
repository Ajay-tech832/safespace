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
            "question" => fractal()->item($data->question)->transformWith(new QuestionTransformer)->serializeWith(new \Spatie\Fractalistic\ArraySerializer())->toArray(),
            "answer" => $data->answer,
             
        ];
    }
}