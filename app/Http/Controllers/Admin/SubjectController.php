<?php

namespace App\Http\Controllers\Admin;

use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::withTrashed()->paginate(20);
        $serialNumber = $subjects->perPage() * ($subjects->currentPage() - 1);
        return view('admin.subject.index', ['subjects' => $subjects, 'serialNumber' => $serialNumber]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = $request->validate([
            'title' => 'required|min:4|unique:subjects,title',
            'description' => 'nullable',
        ]);
        $subject['user_id'] = auth()->id();
        $subject = Subject::create($subject);
        return redirect()
            ->back()
            ->with('flash', "Subject <i>{$subject->title}</i> is being created.")
            ->with('flash-class', 'is-primary');
    }
}
