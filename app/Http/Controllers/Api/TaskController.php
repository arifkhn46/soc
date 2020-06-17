<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Enum\TaskState;
use App\Enum\TaskType;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Task::class);

        return new TaskCollection(auth()->user()->tasks()->get());
    }

    /**
     * Store a newly created task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Task::class);

        $task = $this->validateRequest($request);

        if (!$request->get('assignee_id')) {
            $task['assignee_id'] = auth()->id();
        }

        $task['state'] = TaskState::assigned();

        $task = auth()->user()->tasks()->create($task);

        //default state

        return (new TaskResource($task))
                    ->additional([
                        'message' => $task['title'] . ' created!',
                    ]);
    }


    /**
     * Update the task.
     *
     * @param  Task $task
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $allowedStates = [
            TaskState::assigned(),
            TaskState::inProgress(),
            TaskState::onHold(),
            TaskState::completed()
        ];

        $rules = [
            'state' => [
                'int',
                function($attribute, $value, $fail) use ($request, $task, $allowedStates) {
                    $state = $request->get('state');
                    if ($allowedStates && $task->state != TaskState::created() && $task->state != $state && !in_array($state, $allowedStates)) {
                        $fail($attribute . ' is invalid.');
                    }
                }
            ]
        ];

        $task->update($this->validateRequest($request, $rules));

        return (new TaskResource($task))
                ->additional([
                    'message' => $task['title'] . ' updated!',
                ]);
    }

    /**
     * Destroy the task.
     *
     * @param  Task $task
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Task $task)
    {
        $task->delete();
        
        return response()
                ->json(['message' => 'Task deleted']);
    }

    private function validateRequest(Request $request,  $rules = [])
    {
        $validation_rules = [
            'title' => 'required',
            'description' => 'required',
            'type' => 'required|int|in:' . implode(',', TaskType::getAllTypesId()),
            'subject_id' => 'sometimes|required|exists:subjects,id',
            'chapter_id' => ['sometimes', 'required', 'exists:chapters,id', function($attribute, $value, $fail) use($request) {
                $chapter = \DB::table('chapters')->where([
                    ['subject_id', '=', $request->get('subject_id')],
                    ['id', '=', $value],
                ])->get();

                if ($chapter->isEmpty()) {
                    $fail($attribute . ' is invalid.');
                }
            }],
            'assignee_id' => [function($attribute, $value, $fail) {
                if ($value) {
                    $user = \DB::table('users')->where([
                        ['id', '=', $value],
                    ])->get();

                    if ($user->isEmpty()) {
                        $fail($attribute . ' is invalid.');
                    }
                }
            }],
            'start_at' => ['bail', 'required' , 'date_format:Y-m-d H:i:s', function($attribute, $value, $fail) {
                $start_date = \Carbon\Carbon::createFromDate($value);
                
                if ($start_date->isPast()) {
                    $fail('Start date should be greater than ' . \Carbon\Carbon::now()->format('d-m-Y H:i:s'));
                }
            }],
            'end_at' => 'required|date_format:Y-m-d H:i:s|after:start_at',
        ] + $rules;

        return $request->validate($validation_rules);

    }
}
