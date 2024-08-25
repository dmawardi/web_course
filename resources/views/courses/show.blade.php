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
            <h1 class="text-4xl font-bold text-green-700 mb-4">{{$course->title}}</h1>
            <div class="text-gray-600 mb-6">
                 {!!$course->description!!}
            </div>
             
             <!-- Button box -->
             <div class="mt-8 flex justify-between">`
                    <button-link class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Previous
                    </button-link>
                 <button-link class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                     Start Chapter 1
                 </button-link>
             </div>
         </div>
        <div class="w-4/12 bg-green-200 rounded-lg shadow-lg">
            <x-sidebar></x-sidebar>
        </div>
     </div>
</div>
</x-app-layout>