<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Model\TimeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        auth()->user()->timeTables()->create(
            $request->validate([
                'start_date' => [
                    'required',
                    function ($attribute, $value, $fail) {

                    }
                ],
                'end_date' => [
                    'required',
                    function($attribute, $value, $fail) use($request) {
                        $start_date = \Carbon\Carbon::parse($request->get('start_date'));
                        $end_date = \Carbon\Carbon::parse($value);

                        if ($end_date->equalTo($start_date) || $end_date->lessThan($start_date)) {
                            $fail('End date must be greater than start date');
                        }
                    }
                ],
            ])
        );

        return response()
            ->json(['message' => 'Created!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\TimeTable $timeTable
     * @return \Illuminate\Http\Response
     */
    public function addTasks(Request $request, TimeTable $timeTable)
    {

        $task = $request->validate([
            'day' => [
                'bail',
                'required',
                function($attribute, $value, $fail) use($timeTable) {
                    if ($value < 0) {
                        $fail("Day couldn't be negatvie");
                    }
                    if ($value > $timeTable->duration()) {
                        $fail('Day can not be greater than ' . $timeTable->duration());
                    }
                }
            ],
            'start_time' => [
                'required',
                'regex:/^(?:1[012]|0[0-9]):[0-5][0-9] (am|pm|AM|PM)$/'
            ],
            'end_time' => [
                'bail',
                'required_with:start_time',
                'regex:/^(?:1[012]|0[0-9]):[0-5][0-9] (am|pm|AM|PM)$/',
                function($attribute, $value, $fail) use($timeTable, $request) {
                    if ($request->get('day') && preg_match('/^(?:1[012]|0[0-9]):[0-5][0-9] (am|pm|AM|PM)$/', $request->get('start_time'))) {
                        $start_time = $timeTable->getTaskTiming($request->get('day'), $request->get('start_time'));
                        $end_time = $timeTable->getTaskTiming($request->get('day'), $request->get('end_time'));
                        $timeTableTask = DB::table('time_table_tasks')
                            ->whereBetween('start_time', [$start_time, $end_time])
                            ->orWhereBetween('end_time', [$start_time, $end_time])
                            ->first();

                        if ($timeTableTask) {
                            $fail('Timings overlaping!');
                        }
                    }
                }
            ],
        ]);

        $timeTable->addTask($task);

        return response()
            ->json(['message' => 'Task Added!']);
    }
}
