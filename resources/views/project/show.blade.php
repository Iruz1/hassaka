<x-app-layout>
    <x-slot name="header">
        <h2>Detail Project</h2>
    </x-slot>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Detail Project</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Tanggal:</div>
                    <div class="col-md-10">
                        {{ $project->date ? \Carbon\Carbon::parse($project->date)->format('d M Y') : 'Tanggal tidak tersedia' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Nama Project:</div>
                    <div class="col-md-10">{{ $project->project_name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Lokasi:</div>
                    <div class="col-md-10">{{ $project->location }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Deskripsi:</div>
                    <div class="col-md-10">{{ $project->description }}</div>
                </div>

                <!-- Tambahan untuk log audit -->
                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Dibuat Oleh:</div>
                    <div class="col-md-10">
                        {{ $project->createdBy->name ?? 'Admin' }}
                        <span class="text-muted">
                            ({{ $project->created_at ? \Carbon\Carbon::parse($project->created_at)->format('d M Y H:i') : 'Waktu tidak tersedia' }})
                        </span>
                    </div>
                </div>

                @if($project->updated_by)
                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Terakhir Diubah Oleh:</div>
                    <div class="col-md-10">
                        {{ $project->updatedBy->name ?? 'Admin' }}
                        <span class="text-muted">
                            ({{ $project->updated_at ? \Carbon\Carbon::parse($project->updated_at)->format('d M Y H:i') : 'Waktu tidak tersedia' }})
                        </span>
                    </div>
                </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('project.edit', $project->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('project.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
