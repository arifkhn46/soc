<?php

namespace App\Http\Controllers;

use Auth;
use App\CourseType;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
    	if (Auth::check()) {
    		return redirect('home');
        }
        return redirect('login');
        $courseTypes = CourseType::latest()->get();
        return view('welcome', ['courseTypes' => $courseTypes]);
    }
}
