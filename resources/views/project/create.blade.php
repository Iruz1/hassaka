<x-app-layout>
    <x-slot name="header">
        <h2>Tambah Jadwal Project Baru</h2>
    </x-slot>

    <div class="container">
        <form action="{{ route('project.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
            </div>

            <div class="mb-3">
                <label for="project_name" class="form-label">Nama Project</label>
                <input type="text" class="form-control" id="project_name" name="project_name" value="{{ old('project_name') }}" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('project.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-app-layout>
