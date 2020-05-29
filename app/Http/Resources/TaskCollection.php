<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Enum\TaskState;
use App\Enum\TaskType;

class TaskCollection extends ResourceCollection
{
     /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'tasks';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (\App\Task $task) {
            return (new TaskResource($task));
        });

        return parent::toArray($request);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'states' => TaskState::all(),
                'types' => TaskType::all(),
            ],
        ];
    }
}
