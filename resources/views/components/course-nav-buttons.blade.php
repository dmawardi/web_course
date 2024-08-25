@props(['previousHref' => '', 'previousText'=>'', 'nextHref'=>'', 'nextText'=>''])
<div class="mt-8 flex justify-between">
    <div>
        @if($previousHref && $previousText)
            <a href="{{ $previousHref }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                {{ $previousText }}
            </a>
        @endif
    </div>
    <div class="ml-auto">
        @if($nextHref && $nextText)
            <a href="{{ $nextHref }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                {{ $nextText }}
            </a>
        @endif
    </div>
</div>