<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 dark:text-blue-500 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-grey dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-blue-700 dark:text-blue-400 mb-4">Project Schedule</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Nama Project</th>
                        <th class="px-4 py-2 text-left">Lokasi</th>
                        <th class="px-4 py-2 text-left">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($project->date)->translatedFormat('d F Y') }}</td>
                            <td class="px-4 py-2">{{ $project->project_name }}</td>
                            <td class="px-4 py-2">{{ $project->location }}</td>
                            <td class="px-4 py-2">{{ Str::limit($project->description, 50) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">Tidak ada data project</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
</x-app-layout>
