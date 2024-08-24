@props(['href' => ''])
<a href="{{ $href }}"
{{ $attributes->merge(['class' => 'inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600']) }}>
    {{ $slot }}
</a>
