@props(['chapters'=>[], 'currentChapter'=>0, 'currentModule'=>0])
<div>
    <h2 class="text-2xl font-semibold text-green-700 mb-4">Course Outline:</h2>
        <ul class="list-none space-y-2 text-gray-800 my-4 mx-4">
            @foreach($chapters as $chapter)
            <li>
                <div class="flex">
                    <!-- Active chapter strip -->
                    <div class="w-1 {{$chapter->order == $currentChapter ? 'bg-orange-400' : ''}}"></div>
                    <div class="w-11/12 ml-1">
                        <strong>Ch{{$chapter->order}} - {{$chapter->title}}</strong>
                    </div>
                </div>
                @if(Route::currentRouteName() === 'modules.show' && $chapter->modules->count() > 0)
                <ul class="list-none space-y-2 text-gray-800 ml-4">
                    @foreach($chapter->modules as $module)
                    <li>
                    <div class="flex">
                    <!-- Active chapter strip -->
                    <div class="w-1 {{$module->order == $currentModule ? 'bg-orange-400' : ''}}"></div>
                    <div class="w-11/12 ml-1">
                        {{$module->order}} - {{$module->title}}
                    </div>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
</div>