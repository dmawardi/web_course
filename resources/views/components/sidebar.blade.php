@props(['chapters'=>[], 'currentChapter'=>0, 'currentModule'=>null, 'currentQuestion'=>0, 'course'=>null])
<div>
    <h2 class="text-2xl font-semibold text-green-700 mb-4">Course Outline:</h2>
        <ul class="list-none space-y-2 text-gray-800 my-4 mx-4">

        <!-- Chapters -->
            @foreach($course->chapters as $chapter)
            <li>
                <a href="{{ route('modules.show', ['course' => $course->id, 'chapter' => $chapter->id, 'module' => $chapter->modules->first()->id]) }}">
                <div class="flex">
                    <!-- Active strip -->
                    <div class="w-1 {{$chapter->order == $currentChapter ? 'bg-orange-400' : ''}}"></div>
                    <div class="w-11/12 ml-1">
                        <strong>Ch{{$chapter->order}} - {{$chapter->title}}</strong>
                    </div>
                </div>
                </a>
                @if(in_array(Route::currentRouteName(), ['modules.show', 'questions.show']) && $chapter->modules->count() > 0 && $currentChapter == $chapter->order)
                <ul class="list-none space-y-2 text-gray-800 ml-4">

                    <!-- Modules -->
                    @foreach($chapter->modules as $module)
                    <li>
                    <a href="{{ route('modules.show', ['course' => $course->id, 'chapter' => $chapter->id, 'module' => $module->id]) }}">
                        <div class="flex">
                        <!-- Active strip -->
                        <div class="w-1 {{$module->order == $currentModule->order ? 'bg-orange-400' : ''}}"></div>
                        <div class="w-11/12 ml-1 hover:text-blue-400">
                            {{$module->order}} - {{$module->title}}
                        </div>
                        </div>
                    </a>
                    @if(in_array(Route::currentRouteName(), ['modules.show', 'questions.show']) && $currentModule->questions->count() > 0 && $currentModule->id == $module->id)
                    <ul class="list-none space-y-2 text-gray-800 ml-4">

                        <!-- Question -->
                        @foreach($currentModule->questions as $question)
                        <li>
                            <a href="{{ route('questions.show', ['course' => $course->id, 'chapter' => $chapter->id, 'module' => $module->id, 'question' => $question->id]) }}">
                            <div class="flex">
                            <!-- Active strip -->
                                <div class="w-1 {{$question->id == $currentQuestion ? 'bg-orange-400' : ''}}"></div>
                                <div class="w-11/12 ml-1 hover:text-blue-400">Q.{{$question->order}}</div>
                            </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
</div>