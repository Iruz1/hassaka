<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit File: ') . $file->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mb-4 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium">Sedang mengedit: {{ $file->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Gunakan form di bawah untuk mengubah metadata atau konten.</p>
                        </div>
                        <a href="{{ route('databank.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Kembali ke Daftar
                        </a>
                    </div>

                    <div class="mb-6">
                        <iframe src="{{ $file->webViewLink }}?embedded=true"
                                class="w-full h-[500px] rounded border border-gray-300 dark:border-gray-600"
                                allowfullscreen>
                        </iframe>
                    </div>

                    <form method="POST" action="{{ route('databank.update', $file->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Baru (Opsional)</label>
                            <input id="name" name="name" type="text" value="{{ $file->name }}"
                                   class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Konten</label>
                            <textarea id="content" name="content" rows="10"
                                      class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                      placeholder="Tambahkan konten baru jika ingin memperbarui isi file..."></textarea>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('databank.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded hover:bg-gray-600">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
