@props(['id' => null, 'maxWidth' => null, 'color' => ""])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4 {{ $color == "" ? '' : 'bg-'.$color.'-300' }}">
        <div class="text-lg font-black">
            {{ $title }}
        </div>

        <div class="mt-4" style="max-height: 440px;overflow-y:auto">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>
