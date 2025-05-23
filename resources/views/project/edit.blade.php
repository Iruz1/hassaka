<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Project
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Form Update -->
                    <form action="{{ route('project.update', $project->id) }}" method="POST" class="mb-6">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="project_name" class="block text-gray-700 font-semibold">Nama Project</label>
                            <input type="text" name="project_name" id="project_name"
                                value="{{ old('project_name', $project->project_name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="mb-4">
                            <label for="location" class="block text-gray-700 font-semibold">Lokasi</label>
                            <input type="text" name="location" id="location"
                                value="{{ old('location', $project->location) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-semibold">Deskripsi</label>
                            <textarea name="description" id="description"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $project->description) }}</textarea>
                        </div>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
                            Update Project
                        </button>
                    </form>

                    <!-- Form Delete (Dipisah) -->
                    <form action="{{ route('project.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus project ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                            Hapus Project
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
