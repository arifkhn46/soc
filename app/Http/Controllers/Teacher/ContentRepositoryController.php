<?php

namespace App\Http\Controllers\Teacher;

use App\Subject;
use App\ContentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentRepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repositories = ContentRepository::withTrashed()->where('user_id', auth()->id())->paginate(20);
        $serialNumber = $repositories->perPage() * ($repositories->currentPage() - 1);
        return view('teacher.content_repository.index', ['repositories' => $repositories, 'serialNumber' => $serialNumber]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.content_repository.create');
    }

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
