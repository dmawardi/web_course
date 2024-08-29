@props(['currentChapter'=>0, 'currentModule'=>null, 'currentQuestion'=>null, 'course'=>null])
<div>
    <h2 class="text-2xl font-semibold text-green-700 mb-4">Course Outline:</h2>
        <ul class="list-none space-y-2 text-gray-800 my-4 ml-4 text-sm">
            <li>
                <a href="{{ route('courses.show', $course->id) }}">
                <div class="flex">
                    <!-- Active strip -->
                    <div class="ml-1">
                        <strong>Course Overview</strong>
                    </div>
                </div>
                </a>
            </li>
        <!-- Chapters -->
            @foreach($course->chapters as $chapter)
            <li>
                <a href="{{ route('modules.show', ['course' => $course->id, 'chapter' => $chapter->order, 'module' => $chapter->modules->first()->order]) }}">
                <div class="flex">
                    <!-- Active strip -->
                    <div class="w-1 {{$chapter->id == ($currentChapter->id ?? '') ? 'bg-orange-400' : ''}}"></div>
                    <div class="w-11/12 ml-1">
                        <strong>Ch{{$chapter->order}} - {{$chapter->title}}</strong>
                    </div>
                </div>
                </a>
                @if(in_array(Route::currentRouteName(), ['modules.show', 'questions.show']) && $chapter->modules->count() > 0 && $currentChapter->order == $chapter->order)
                <ul class="list-none space-y-2 text-gray-800 ml-4">

                    <!-- Modules -->
                    @foreach($chapter->modules as $module)
                    <li>
                    <a href="{{ route('modules.show', ['course' => $course->id, 'chapter' => $chapter->order, 'module' => $module->order]) }}">
                        <div class="flex">
                        <!-- Active strip -->
                        <div class="w-1 {{$module->id == $currentModule->id ? 'bg-orange-400' : ''}}"></div>
                        <div class="w-11/12 ml-1 hover:text-blue-400">
                            {{$module->order}} - {{$module->title}}
                        </div>
                        </div>
                    </a>
                    @if(in_array(Route::currentRouteName(), ['modules.show', 'questions.show']) && $currentModule->questions->count() > 0 && $currentModule->id == $module->id)
                    <ul class="list-none space-y-2 text-gray-800 ml-4">

                        <!-- Question -->
                        @foreach($module->questions as $question)
                        <li>
                            <a href="{{ route('questions.show', ['course' => $course->id, 'chapter' => $chapter->order, 'module' => $module->order, 'question' => $question->order]) }}">
                            <div class="flex">
                            <!-- Active strip -->
                                <div class="w-1 {{$question->id == ($currentQuestion->id ?? '') ? 'bg-orange-400' : ''}}"></div>
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