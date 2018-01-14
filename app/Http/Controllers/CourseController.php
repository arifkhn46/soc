<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseType;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->paginate(20);
        $serialNumber = $courses->perPage() * ($courses->currentPage()-1);
        return view('course.index', ['courses' => $courses, 'serialNumber' => $serialNumber]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courseTypes = CourseType::latest()->get();
        return view('course.create', ['courseTypes' => $courseTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = $request->validate([
            'title' => 'required|min:4|unique:courses,title',
            'description' => 'nullable',
            'course_type_id' => 'exists:course_types,id'
        ]);
        $course['user_id'] = auth()->id();
        $course = Course::create($course);
        return redirect()
            ->back()
            ->with('flash', "Course <i>{$course->title}</i> is being created.")
            ->with('flash-class', 'is-primary');
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
    public function edit(Course $course)
    {
        $courseTypes = CourseType::latest()->get();
        return view('course.edit', ['course' => $course, 'courseTypes' => $courseTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $validations = [
            'title' => 'required|min:4',
            'description' => 'nullable',
            'course_type_id' => 'exists:course_types,id'
        ];

        if ($request->get('title') != $course->title) {
            $validations['title'] .= '|unique:courses,title';
            $course->title = $request->get('title');
        }

        $validatedCourse = $request->validate($validations);
        $course->description = $request->get('description', $course->description);
        $course->course_type_id = $request->get('course_type_id', $course->course_type_id);
        $course->save();

        return redirect()
            ->back()
            ->with('flash', "Course {$course->title} has been updated!")
            ->with('flash-class', 'is-primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()
            ->back()
            ->with('flash', "Course {$course->title} has been deleted!")
            ->with('flash-class', 'is-danger');
    }
}
