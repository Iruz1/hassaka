@extends('layouts.app')

@section('title', 'Jadwal Project')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Jadwal Project Bulanan</h1>
        @can('create', App\Models\ProjectSchedule::class)
            <a href="{{ route('schedules.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Jadwal
            </a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="15%">Tanggal</th>
                            <th width="20%">Nama Project</th>
                            <th width="15%">Lokasi</th>
                            <th width="40%">Deskripsi</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->date->format('d M Y') }}</td>
                                <td>{{ $schedule->project_name }}</td>
                                <td>{{ $schedule->location }}</td>
                                <td>{{ Str::limit($schedule->description, 100) }}</td>
                                <td>
                                    @can('update', $schedule)
                                        <a href="{{ route('schedules.edit', $schedule->id) }}"
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('schedules.destroy', $schedule->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus jadwal ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada jadwal project</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tampilan Kalender Bulanan -->
    <div class="mt-5">
        <h3 class="mb-3">Kalender Project</h3>
        @foreach($groupedSchedules as $month => $monthSchedules)
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5>{{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}</h5>
                </div>
                <div class="card-body">
                    @foreach($monthSchedules as $schedule)
                        <div class="mb-3 p-3 border rounded">
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-1">{{ $schedule->project_name }}</h5>
                                <span class="badge bg-primary">
                                    {{ $schedule->date->format('d M') }}
                                </span>
                            </div>
                            <div class="text-muted mb-1">
                                <i class="fas fa-map-marker-alt"></i> {{ $schedule->location }}
                            </div>
                            <p class="mb-0">{{ $schedule->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
