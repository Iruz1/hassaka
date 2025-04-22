<x-app-layout>
    <x-slot name="header">
        <div class="row justify-content-between mb-4">
            <div class="col-md-6">
                <h2>Jadwal Project Bulanan</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('project.create') }}" class="btn btn-primary">Tambah Jadwal</a>
                <a href="{{ route('project.calendar') }}" class="btn btn-info">Lihat Kalender</a>
            </div>
        </div>
    </x-slot>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Project</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedules as $project)
                    <tr>
                        <!-- FIXED: Proper date formatting -->
                        <td>{{ \Carbon\Carbon::parse($project->date)->format('d M Y') }}</td>
                        <td>{{ $project->project_name }}</td>
                        <td>{{ $project->location }}</td>
                        <td>{{ Str::limit($project->description, 50) }}</td>
                        <td>
                            <a href="{{ route('project.edit', $project->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('project.destroy', $project->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
