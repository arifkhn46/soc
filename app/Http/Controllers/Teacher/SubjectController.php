<?php

namespace App\Http\Controllers\Teacher;

use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * Add a new subject in a content repository.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'content_repository_id' => 'required|exists:content_repositories,id',
            'category_id' => 'required|exists:subject_categories,id',
            'description' => 'required',
        ]);
        $subject = Subject::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'user_id' => auth()->id(),
        ]);
        $subject->contentRepositories()->attach($data['content_repository_id']);
        return redirect()
            ->back()
            ->with('flash', "Subject <i>{$subject->title}</i> created successfully!")
            ->with('flash-class', 'is-primary');
    }
}
