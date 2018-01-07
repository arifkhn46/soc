<?php

namespace App\Http\Controllers;

use App\ExamType;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $examTypes = ExamType::where('status', 1)->get();
        return view('welcome', ['examTypes' => $examTypes]);
    }
}
