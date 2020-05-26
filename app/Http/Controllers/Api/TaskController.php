<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $task = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required|int',
            'state' => 'required|int',
            'subject_id' => 'required|exists:subjects,id',
            'chapter_id' => ['required', 'exists:chapters,id', function($attribute, $value, $fail) use($request) {
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
            'start_at' => 'required|date_format:Y-m-d H:i:s',
            'end_at' => 'required|date_format:Y-m-d H:i:s|after:start_at',
        ]);
        
        if (!$request->get('assignee_id')) {
            $task['assignee_id'] = auth()->id();
        }
        
        $task = auth()->user()->tasks()->create($task);
                
        return (new TaskResource($task))
                    ->additional([
                        'message' => $task['title'] . ' created!',
                    ]);
    }
}
