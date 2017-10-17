<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Constructor of RolesController class.
     */
    public function __construct()
    {
        $this->middleware('admin');
        parent::__construct();
    }
    
    public function index()
    {
        return view('welcome');
    }
}
