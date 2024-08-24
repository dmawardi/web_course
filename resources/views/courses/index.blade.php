<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Add pagination links -->
                    <div class="pagination">
                        {{ $courses->links() }}
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($courses as $course)
                        <x-course-card
                            :title="$course->title"
                            :description="$course->description"
                            :mediaLink="$course->media_link"
                            :createdBy="$course->creator ? $course->creator->name : null"
                            :courseId="$course->id"
                        />
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>