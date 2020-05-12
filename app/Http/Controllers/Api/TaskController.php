<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
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

        auth()->user()->tasks()->create($task);

        return  response()
                    ->json(['message' => $task['title'] . ' created!'])
                    ->setStatusCode(Response::HTTP_CREATED);
    }
}
