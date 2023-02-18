<div>
    @if ($labores->count())
        <table class="w-full overflow-x-scroll table-fixed">
            <thead>
                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Labor</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-light text-gray-600">
                @foreach ($labores as $labor)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$labor->id}})" class="border-b {{ $labor->id == $labor_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $labor->labor }}</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="px-6 py-4">
            No existe ningún registro coincidente
        </div>
    @endif
        <div class="px-4 py-4">
            {{ $labores->links() }}
        </div>
</div>
