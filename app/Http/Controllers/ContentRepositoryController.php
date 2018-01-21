<?php

namespace App\Http\Controllers;

use App\ContentRepository;
use Illuminate\Http\Request;

class ContentRepositoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contentRepository = $request->validate([
            'title' => 'required'
        ]);
        $contentRepository['user_id'] = auth()->id();
        $contentRepository = ContentRepository::create($contentRepository);
        return redirect()
            ->back()
            ->with('flash', "Content Repository <i>{$contentRepository->title}</i> is being created.")
            ->with('flash-class', 'is-primary');
    }
}
