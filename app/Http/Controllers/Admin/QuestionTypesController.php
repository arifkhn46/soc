<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QuestionType;

class QuestionTypesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $questionType = $request->validate([
            'name' => 'required|min:4|unique:question_types,title'
        ]);
        $questionType['user_id'] = auth()->id();
        $questionType = QuestionType::create($questionType);
        return redirect()
            ->back()
            ->with('flash', "Question Type <i>{$questionType->name}</i> created!.")
            ->with('flash-class', 'is-primary');
    }
}
