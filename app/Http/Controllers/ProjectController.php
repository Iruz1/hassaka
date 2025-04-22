<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProjectController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $schedules = Project::orderBy('date')->get();
        return view('project.index', compact('schedules'));
    }

    public function create()
    {
        return view('project.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Project::create($validated);

        return redirect()->route('project.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function show(Project $schedule)
    {
        return view('project.show', ['project' => $schedule]);
    }

    public function edit(Project $schedule)
    {
        return view('project.edit', ['project' => $schedule]);
    }

    public function update(Request $request, Project $schedule)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $schedule->update($validated);

        return redirect()->route('project.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy(Project $schedule)
    {
        $schedule->delete();
        return redirect()->route('project.index')->with('success', 'Jadwal berhasil dihapus!');
    }

    public function calendar()
    {
        $schedules = Project::orderBy('date')->get();
        return view('project.calendar', compact('schedules'));
    }
}
