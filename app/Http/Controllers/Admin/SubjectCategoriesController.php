<?php

namespace App\Http\Controllers\Admin;

use App\SubjectCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjectCategories = SubjectCategory::withTrashed()->paginate(20);
        $serialNumber = $subjectCategories->perPage() * ($subjectCategories->currentPage() - 1);
        return view('admin.subject_categories.index', ['subjectCategories' => $subjectCategories, 'serialNumber' => $serialNumber]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subject_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subjectCategory = $request->validate([
            'title' => 'required|min:4|unique:subject_categories,title',
            'description' => 'nullable',
        ]);
        $subjectCategory['user_id'] = auth()->id();
        $subjectCategory = SubjectCategory::create($subjectCategory);
        return redirect()
            ->back()
            ->with('flash', "Subject <i>{$subjectCategory->title}</i> is being created.")
            ->with('flash-class', 'is-primary');
    }
}
