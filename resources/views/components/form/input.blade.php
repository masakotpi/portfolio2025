<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="block font-bold mb-1">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
           class="w-full border border-gray-300 p-2 rounded" />
</div>