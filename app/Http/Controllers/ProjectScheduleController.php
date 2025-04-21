<?php

namespace App\Http\Controllers;

use App\Models\ProjectSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $schedules = ProjectSchedule::orderBy('date')->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        if (!Gate::allows('is-admin')) {
            abort(403);
        }
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('is-admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        ProjectSchedule::create($validated);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit(ProjectSchedule $schedule)
    {
        if (!Gate::allows('is-admin')) {
            abort(403);
        }

        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, ProjectSchedule $schedule)
    {
        if (!Gate::allows('is-admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(ProjectSchedule $schedule)
    {
        if (!Gate::allows('is-admin')) {
            abort(403);
        }

        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus');
    }
}
