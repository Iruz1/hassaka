<?php

namespace App\Http\Controllers;

use App\Models\ProjectSchedule; // Pastikan model ini ada
use Illuminate\Http\Request;

class ProjectScheduleController extends Controller
{
    /**
     * Constructor untuk middleware
     */
    public function __construct()
    {
        // Middleware auth berlaku untuk semua method
        $this->middleware('auth');

        // Middleware verified hanya untuk method tertentu
        $this->middleware('verified')->only([
            'create', 'store',
            'edit', 'update',
            'destroy'
        ]);
    }

    /**
     * Menampilkan daftar jadwal
     */
    public function index()
    {
        $schedules = ProjectSchedule::orderBy('date')->get();
        $groupedSchedules = $schedules->groupBy(function($item) {
            return $item->date->format('Y-m');
        });

        return view('schedules.index', compact('schedules', 'groupedSchedules'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        return view('schedules.create');
    }

    /**
     * Menyimpan data baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        ProjectSchedule::create($validated);

        return redirect()->route('schedules.index')
                       ->with('success', 'Schedule created successfully');
    }

    /**
     * Menampilkan form edit
     */
    public function edit(ProjectSchedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    /**
     * Update data
     */
    public function update(Request $request, ProjectSchedule $schedule)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')
                       ->with('success', 'Schedule updated successfully');
    }

    /**
     * Hapus data
     */
    public function destroy(ProjectSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')
                       ->with('success', 'Schedule deleted successfully');
    }
}
