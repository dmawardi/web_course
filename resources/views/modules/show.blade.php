<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($course->title) }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12 bg-white">
    <!-- Course Overview Section -->
     <div class="flex">
         <div class="bg-white p-6 w-8/12">
            <h1 class="text-4xl font-bold text-green-700 mb-4">{{$module->title}}</h1>
            <div class="text-gray-600 mb-6">
                 {!!$module->description!!}
            </div>
             
             <!-- Button box -->
            <x-course-nav-buttons
            :previousHref="$previous"
            previousText="Previous"
            :nextHref="$next"
            nextText="Next"
            ></x-course-nav-buttons>
            
         </div>
        <div class="w-4/12 bg-green-200 rounded-lg shadow-lg mx-2 p-4">
            <x-sidebar :course="$course" :currentChapter="$chapter" :currentModule="$module"></x-sidebar>
        </div>
     </div>
</div>
</x-app-layout>