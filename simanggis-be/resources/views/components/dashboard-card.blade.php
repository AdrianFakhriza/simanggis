@props(['title', 'value', 'color'])

<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ $title }}</h5>
    <p class="text-3xl font-semibold text-{{ $color }}-600">{{ $value }}</p>
</div>
