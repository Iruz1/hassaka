<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Dokumen Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Error validation alerts -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success alert -->
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('databank.upload.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Added required title field -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Judul Dokumen <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" required
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Document upload field -->
                        <div class="mb-4">
                            <label for="document" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Pilih Dokumen <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="document" id="document" required
                                   class="block w-full text-sm text-gray-500
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-md file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-blue-50 file:text-blue-700
                                   hover:file:bg-blue-100
                                   dark:file:bg-gray-700 dark:file:text-gray-300
                                   dark:hover:file:bg-gray-600"
                                   accept=".doc,.docx,.rtf,.odt,.txt,.xls,.xlsx,.ods,.csv,.ppt,.pptx,.odp,.pdf">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Maksimal ukuran file: 10MB. Format yang didukung: DOC, DOCX, PDF, XLS, XLSX, PPT, PPTX, dll.
                            </p>
                        </div>

                        <!-- Description field -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Deskripsi (Opsional)
                            </label>
                            <textarea name="description" id="description" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <!-- Fixed route name to databank.index -->
                            <a href="{{ route('databank') }}"
                               class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                Kembali
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                                Upload Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- disini masih diupload masalahnya -->
