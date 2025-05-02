<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard.
     */
    public function index()
    {
        // Ambil data project terbaru, bisa dibatasi misalnya 5 atau 10 project
        $projects = Project::latest()->take(5)->get();

        return view('dashboard', compact('projects'));
    }
}
