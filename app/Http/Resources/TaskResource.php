<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class TaskResource extends JsonResource
{
     /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'task';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $task_types = config('soc.task_types');
        $type = Arr::first($task_types, function ($value, $key) {
            return $value['id' ] == $this->type;
        });
        
        return [
            'title' => $this->title,
            'description' => $this->description,
            'type' => $type['name'],
            'subject' => $this->subject->name,
            'chapter' => $this->chapter->name,
            'start_at' => Carbon::parse($this->start_at)->format('d-m-Y H:m:s'),
            'end_at' => Carbon::parse($this->end_at)->format('d-m-Y H:m:s'),
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y H:m:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d-m-Y H:m:s'),
            'owner_id' => $this->owner_id,
            'id' => $this->id,
        ];
    }
}
