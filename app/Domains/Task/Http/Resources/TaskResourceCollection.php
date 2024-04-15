<?php

namespace App\Domains\Task\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskResourceCollection extends ResourceCollection
{


    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
