<?php

namespace App\Transformers;

use App\Entities\Task;
use App\Enums\StatusEnum;
use League\Fractal\TransformerAbstract;

/**
 * Class TaskTransformer.
 *
 * @package namespace App\Transformers;
 */
class TaskTransformer extends TransformerAbstract
{
    /**
     * Transform the Task entity.
     *
     * @param \App\Entities\Task $model
     *
     * @return array
     */
    public function transform(Task $model)
    {
        return [
            'id'            => (int) $model->id,
            'title'         => $model->title,
            'description'   => $model->description,
            'status_id'     => StatusEnum::getById($model->status->id)->getTranslateName(),
            'user_id'       => (int) $model->user_id,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString()
        ];
    }
}
