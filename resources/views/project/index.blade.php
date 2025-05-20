<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-blue-500 leading-tight">
            {{ __('Schedule') }}
            </h2>
            <div>
                @can('create', App\Models\Project::class)
                    <a href="{{ route('project.create') }}" class="btn btn-primary me-2">
                        <i class="fas fa-plus me-1"></i> Tambah Jadwal
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-nowrap">Tanggal</th>
                                    <th scope="col">Nama Project</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col" class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($projects as $project)
                                <tr>
                                    <td class="text-nowrap">{{ \Carbon\Carbon::parse($project->date)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $project->project_name }}</td>
                                    <td>{{ $project->location }}</td>
                                    <td>{{ Str::limit($project->description, 50) }}</td>
                                    <td class="text-end">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('project.show', $project->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                                <i class="fas fa-eye">Details</i>
                                            </a>

                                            @can('update', $project)
                                                <a href="{{ route('project.edit', $project->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                    <i class="fas fa-edit">Edit</i>
                                                </a>
                                            @endcan

                                            @can('delete', $project)
                                                <form action="{{ route('project.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus project ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                        <i class="fas fa-trash-alt">Hapus</i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Tidak ada data project</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($projects->hasPages())
                    <div class="mt-4">
                        {{ $projects->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
