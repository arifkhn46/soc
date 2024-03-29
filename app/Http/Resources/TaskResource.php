<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Enum\TaskType;
use App\Enum\TaskState;


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
        $type = TaskType::getName($this->type);
        
        return [
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'type_name' => $type,
            'subject_id' => $this->subject_id ?: '',
            'chapter_id' => $this->chapter_id ?: '',
            'subject' => $this->subject_id ? $this->subject->name : '',
            'chapter' => $this->chapter_id ? $this->chapter->name : '',
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y H:m:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d-m-Y H:m:s'),
            'owner_id' => $this->owner_id,
            'state' => $this->state,
            'state_name' => TaskState::getName($this->state),
            'id' => $this->id,
        ];
    }
}
