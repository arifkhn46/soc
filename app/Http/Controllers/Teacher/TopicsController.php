<?php

namespace App\Http\Controllers\Teacher;

use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicsController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $topic = $request->validate([
      'title' => 'required|string',
      'body' => 'required|string',
      'subject_id' => 'required|exists:subjects,id'
    ]);
    $topic['user_id'] = auth()->id();
    $topic = Topic::create($topic);
    return redirect()
      ->back()
      ->with('flash', "Topic <i>{$topic->title}</i> created!.")
      ->with('flash-class', 'is-primary');
  }
}
