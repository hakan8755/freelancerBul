<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    $user = auth()->user();

    $jobCount = \App\Models\Job::where('user_id', $user->id)->count();
    $applicationCount = \App\Models\Application::where('user_id', $user->id)->count();

    return view('home', compact('jobCount', 'applicationCount'));
}

}
