<div>
    @if ($lotes->count())
        <table class="w-full overflow-x-scroll table-fixed">
            <thead>
                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Sede</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Fundo</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Lote</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-light text-gray-600">
                @foreach ($lotes as $lote)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$lote->id}})" class="border-b {{ $lote->id == $lote_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $lote->Fundo->Sede->sede }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $lote->Fundo->fundo }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $lote->lote }}</span>
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
            {{ $lotes->links() }}
        </div>
</div>
