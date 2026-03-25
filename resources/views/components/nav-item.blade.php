@props(['active', 'icon', 'label', 'href'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 px-4 py-3.5 text-sm font-bold text-white bg-blue-600 rounded-2xl shadow-xl shadow-blue-200 dark:shadow-none transition-all duration-300 transform scale-[1.02]'
            : 'flex items-center gap-3 px-4 py-3.5 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-gray-700/50 rounded-2xl transition-all duration-200 group';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    <svg class="w-5 h-5 {{ ($active ?? false) ? 'text-white' : 'text-gray-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
    </svg>
    <span>{{ $label }}</span>
</a>