<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="p-6 text-gray-900 font-semibold">
                    Your Courses
                </h1>
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($courses as $course)
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <h1 class="text-gray-900 font-semibold">
                                        {{ $course->name }}
                                    </h1>
                                    <p class="text-gray-600">
                                        {{ $course->description }}
                                    </p>
                                    <a href="{{ route('course.show', $course->id) }}" class="text-blue-500">View Course</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
