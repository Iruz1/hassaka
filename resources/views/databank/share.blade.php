<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bagikan Dokumen: ') . $file['name'] }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('drive.share', $file['id']) }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Penerima</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" required>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Akses</label>
                            <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:bg-gray-700 dark:text-white" required>
                                <option value="reader">Hanya Baca</option>
                                <option value="commenter">Boleh Komentar</option>
                                <option value="writer">Boleh Edit</option>
                            </select>
                        </div>

                        <div class="flex justify-between items-center mt-6">
                            <a href="{{ route('databank.index') }}" class="text-sm text-gray-600 hover:underline dark:text-gray-400">← Kembali ke daftar file</a>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                Bagikan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
