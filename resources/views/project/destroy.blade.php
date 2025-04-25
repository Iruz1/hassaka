<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-exclamation-triangle mr-2 text-red-500"></i>
            Konfirmasi Penghapusan Project
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-l-4 border-red-500">
                <div class="p-6">
                    <!-- Alert Warning -->
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <p class="font-bold">Peringatan!</p>
                        </div>
                        <p class="mt-2">Anda akan menghapus project berikut secara permanen!</p>
                    </div>

                    <!-- Project Details -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 w-1/4">Nama Project</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $project->name }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Tanggal</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $project->date->format('d F Y') }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Lokasi</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $project->location }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Deskripsi</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-pre-line">{!! nl2br(e($project->description)) !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Form Actions -->
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="mt-8 flex justify-between">
                        @csrf
                        @method('DELETE')

                        <x-secondary-button onclick="window.location='{{ route('projects.index') }}'">
                            <i class="fas fa-times mr-2"></i> Batal
                        </x-secondary-button>

                        <x-danger-button id="confirm-delete">
                            <i class="fas fa-trash-alt mr-2"></i> Hapus Permanen
                        </x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('confirm-delete').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
