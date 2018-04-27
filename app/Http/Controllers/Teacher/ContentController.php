<?php

namespace App\Http\Controllers\Teacher;

use App\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    /**
     * Store a newly created content.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content_repository_id' => 'required|exists:content_repositories,id',
        ]);
        $content = Content::create($content);
        return redirect()
            ->back()
            ->with('flash', "Content <i>{$content->title}</i> is being created.")
            ->with('flash-class', 'is-primary');
    }
}
