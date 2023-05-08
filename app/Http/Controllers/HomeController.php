<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Doctor' || Auth::user()->role->name == 'Sales Agent' || Auth::user()->role->name == 'Assistant' || Auth::user()->role->name == 'Front Officer'){
        $pageTitle = 'Dashboard';    
        return redirect()->to('/dashboard');
         }
        return redirect()->to('/');
    }
}
