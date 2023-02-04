<div>
    @if ($programacion_de_tractores->count())
        <table class="w-full table-fixed overflow-x-scroll">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 text center">
                        <span class="hidden sm:block">Tractorista</span>
                        <img class="sm:hidden flex mx-auto" src="/img/tabla/tractorista.png" alt="tractortista" width="25">
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Tractor</span>
                        <img class="sm:hidden flex mx-auto" src="/img/tabla/tractor.svg" alt="tractor"
                            width="25">
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Implemento</span>
                        <img class="sm:hidden flex mx-auto" src="/img/tabla/implemento.png" alt="implemento" width="25">
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Día</span>
                        <img class="sm:hidden flex mx-auto" src="/img/tabla/fecha.svg" alt="fecha" width="28">
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Lote</span>
                        <img class="sm:hidden flex mx-auto" src="/img/tabla/lote.png" alt="fecha" width="25">
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Labor</span>
                        <img class="sm:hidden flex mx-auto" src="/img/tabla/labor.svg" alt="labor" width="25">
                    </th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($programacion_de_tractores as $programacion_de_tractor)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$programacion_de_tractor->id}})" class="border-b {{ $programacion_de_tractor->id == $programacion_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->Tractorista->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->Tractor->ModeloDeTractor->modelo_de_tractor }} {{ $programacion_de_tractor->Tractor->numero }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->Implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $programacion_de_tractor->Implemento->numero }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->fecha }}</span>
                                <div class="flex items-center justify-center">
                                    <img src="/img/tabla/{{ $programacion_de_tractor->turno == 'MAÑANA' ? 'sol' : 'luna' }}.svg" alt="turno" width="25">
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-2 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->Lote->lote }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-2 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->labor->labor }}</span>
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
            {{ $programacion_de_tractores->links() }}
        </div>
</div>
