<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            [
                'date' => Carbon::now()->addDays(5),
                'project_name' => 'Website Perusahaan XYZ',
                'location' => 'Jakarta',
                'description' => 'Pembuatan website company profile'
            ],
            [
                'date' => Carbon::now()->addDays(10),
                'project_name' => 'Aplikasi Mobile POS',
                'location' => 'Bandung',
                'description' => 'Pengembangan aplikasi point of sale'
            ],
            // Tambahkan data lain sesuai kebutuhan
        ];

        foreach ($projects as $project) {
            ProjectSchedule::create($project);
        }
    }
}
