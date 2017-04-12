<?php

namespace App\Transformers;

use App\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class TaskTransformer extends TransformerAbstract
{
    public function transform(ProjectTask $task)
    {
        return [
            'name' => $task->name,
        ];
    }
}
