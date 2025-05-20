<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
                            <div class="font-bold">Oops! Something went wrong</div>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4">
                            <div class="font-bold">Success!</div>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    <!-- Form Update -->
                    <form action="{{ route('project.update', $project->id) }}" method="POST" class="mb-6">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="project_name" class="block text-gray-700 font-semibold mb-2">Project Name</label>
                            <input type="text" name="project_name" id="project_name"
                                value="{{ old('project_name', $project->project_name) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="location" class="block text-gray-700 font-semibold mb-2">Location</label>
                            <input type="text" name="location" id="location"
                                value="{{ old('location', $project->location) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                required>
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $project->description) }}</textarea>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Update Project
                            </button>

                            <a href="{{ route('project.index') }}"
                                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Cancel
                            </a>
                        </div>
                    </form>

                    <!-- Form Delete -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <p class="text-gray-600 mb-4">Danger Zone</p>
                        <form action="{{ route('project.destroy', $project->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                Delete Project
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
