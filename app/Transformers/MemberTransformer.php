<?php

namespace App\Transformers;

use App\Models\Member;
use League\Fractal\TransformerAbstract;

class MemberTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform($data): array
    {
        return [
            "is_visible_profile" => $data->is_visible_profile,
            "orientation" => $data->orientation,
            "relationship_status" => $data->relationship_status,
            "looking_for" => $data->looking_for,
            "is_pets" => $data->is_pets,
            "meet_at" => $data->meet_at,
            "religious_views" => $data->religious_views,
            "children" => $data->children,
            "is_smoke" => $data->is_smoke,
            "is_drink" => $data->is_drink,
            "is_canabis" => $data->is_canabis,
            "about" => $data->about,
        ];
    }
}
