<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'budget' => 'nullable|numeric'
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'open';

        Job::create($data);

        return redirect()->route('jobs.index')->with('success', 'İlan oluşturuldu.');
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }
}
