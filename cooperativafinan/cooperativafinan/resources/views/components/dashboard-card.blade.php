@props(['title','value','icon','color'])

<div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between border-l-4 border-{{ $color }}-500">
    <div>
        <p class="text-gray-500">{{ $title }}</p>
        <p class="text-2xl font-bold">{{ $value }}</p>
    </div>
    <div class="text-4xl">{{ $icon }}</div>
</div>
