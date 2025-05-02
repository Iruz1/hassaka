<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Dokumen: ') . $document->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-grey dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium">Sedang mengedit: {{ $document->title }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Perubahan disimpan otomatis</p>
                        </div>
                        <a href="{{ route('databank') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Kembali ke Daftar</a>
                    </div>

                    <div class="w-full h-screen-80 border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                        <iframe
                            src="{{ $collaboraUrl }}"
                            <div class="hidden">
                                 Debug: {{ $collaboraUrl }}
                            </div>
                            class="w-full h-full"
                            frameborder="0"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
