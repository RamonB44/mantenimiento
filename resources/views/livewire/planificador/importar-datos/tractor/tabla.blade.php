<div>
    @if ($tractores->count())
        <table class="w-full overflow-x-scroll table-fixed">
            <thead>
                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Modelo</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Número</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Horómetro</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Sede</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-light text-gray-600">
                @foreach ($tractores as $tractor)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$tractor->id}})" class="border-b {{ $tractor->id == $tractor_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $tractor->ModeloDeTractor->modelo_de_tractor }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $tractor->numero }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $tractor->horometro }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $tractor->Sede->sede }}</span>
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
            {{ $tractores->links() }}
        </div>
</div>
