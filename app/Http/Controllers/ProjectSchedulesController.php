<?php

namespace App\Http\Controllers;

use App\Models\ProjectSchedules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan semua jadwal
    public function index()
    {
        $schedules = ProjectSchedule::orderBy('date')->get();

        // Group by bulan untuk tampilan kalender
        $groupedSchedules = $schedules->groupBy(function($item) {
            return $item->date->format('Y-m');
        });

        return view('schedules.index', compact('schedules', 'groupedSchedules'));
    }

    // Form tambah jadwal
    public function create()
    {
        $this->authorize('create', ProjectSchedule::class);
        return view('schedules.create');
    }

    // Simpan jadwal baru
    public function store(Request $request)
    {
        $this->authorize('create', ProjectSchedule::class);

        $validated = $request->validate([
            'date' => 'required|date',
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        ProjectSchedule::create($validated);

        return redirect()->route('schedules.index')
                         ->with('success', 'Jadwal berhasil ditambahkan');
    }

    // Form edit jadwal
    public function edit(ProjectSchedule $schedule)
    {
        $this->authorize('update', $schedule);
        return view('schedules.edit', compact('schedule'));
    }

    // Update jadwal
    public function update(Request $request, ProjectSchedule $schedule)
    {
        $this->authorize('update', $schedule);

        $validated = $request->validate([
            'date' => 'required|date',
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')
                         ->with('success', 'Jadwal berhasil diperbarui');
    }

    // Hapus jadwal
    public function destroy(ProjectSchedule $schedule)
    {
        $this->authorize('delete', $schedule);

        $schedule->delete();

        return redirect()->route('schedules.index')
                         ->with('success', 'Jadwal berhasil dihapus');
    }
}
