<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use App\Http\Resources\SubjectCollection;
use App\Http\Resources\ChapterResource;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $subjects = Subject::where('active', 1)
                            ->orderBy('name', 'asc')
                            ->get();
        return new SubjectCollection($subjects);
    }

    /**
     * Fetch chapters associated with the given subject id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function chapters(Request $request, Subject $subject)
    {
        $chapters = ChapterResource::collection($subject->chapters);
        
        return $chapters;
    }
}
