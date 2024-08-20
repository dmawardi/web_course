<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        @if($mediaLink)
            <div class="mb-4">
                <img src="{{ $mediaLink }}" alt="{{ $title }}" class="w-full h-48 object-cover rounded-lg">
            </div>
        @endif

        <h1 class="text-gray-900 text-xl font-semibold mb-2">
            {{ $title }}
        </h1>

        <p class="text-gray-600 mb-4">
            {{ $description }}
        </p>

        <div class="text-sm text-gray-500 mb-4">
            Created by: <span class="font-medium text-gray-700">{{ $createdBy }}</span>
        </div>

        <a href="{{ route('courses.show', $courseId) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            View Course
        </a>
    </div>
</div>
