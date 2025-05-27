<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hapus Dokumen: ') . $file['name'] }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <p class="mb-6 text-sm text-red-500">
                        Apakah Anda yakin ingin menghapus dokumen <strong>{{ $file['name'] }}</strong>? Tindakan ini tidak dapat dibatalkan.
                    </p>

                    <form method="POST" action="{{ route('databank.delete', $file['id']) }}">
                        @csrf
                        @method('DELETE')

                        <div class="flex justify-between items-center mt-6">
                            <a href="{{ route('databank.index') }}" class="text-sm text-gray-600 hover:underline dark:text-gray-400">← Kembali ke daftar file</a>
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                Hapus Permanen
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
