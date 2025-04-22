<x-app-layout>
    <x-slot name="header">
        <h2>Edit Jadwal Project</h2>
    </x-slot>

    <div class="container">
        <form action="{{ route('project.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $project->date->format('Y-m-d') }}" required>
            </div>

            <div class="mb-3">
                <label for="project_name" class="form-label">Nama Project</label>
                <input type="text" class="form-control" id="project_name" name="project_name" value="{{ $project->project_name }}" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $project->location }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $project->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('project.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-app-layout>
