<?php

namespace App\Http\Controllers;

use Auth;
use App\ExamType;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
    	if (Auth::check()) {
    		return redirect('home');
    	}
        $examTypes = ExamType::latest()->get();
        return view('welcome', ['examTypes' => $examTypes]);
    }
}
