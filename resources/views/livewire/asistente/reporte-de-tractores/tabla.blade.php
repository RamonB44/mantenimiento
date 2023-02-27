<div>
    @if ($reporte_de_tractores->count())
        <table class="w-full table-fixed overflow-x-scroll">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 text center">
                        <span class="hidden sm:block">Correlativo</span>
                        <img class="sm:hidden flex mx-auto" src="/img/tabla/correlativo.svg" alt="correlativo" width="25">
                    </th>
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
                @foreach ($reporte_de_tractores as $reporte_de_tractor)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$reporte_de_tractor->id}})" class="border-b {{ $reporte_de_tractor->id == $reporte_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $reporte_de_tractor->correlativo  }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $reporte_de_tractor->ProgramacionDeTractor->Tractorista->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">
                                    @if ($reporte_de_tractor->ProgramacionDeTractor->Tractor == null)
                                    Autopropulsado
                                    @else
                                    {{ $reporte_de_tractor->ProgramacionDeTractor->Tractor->ModeloDeTractor->modelo_de_tractor }} {{ $reporte_de_tractor->ProgramacionDeTractor->Tractor->numero }}
                                    @endif                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                @foreach ($reporte_de_tractor->ProgramacionDeTractor->Implementos as $implemento_programacion)
                                {{ $implemento_programacion->Implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implemento_programacion->Implemento->numero }},
                                @endforeach                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $reporte_de_tractor->ProgramacionDeTractor->fecha }}</span>
                                <div class="flex items-center justify-center">
                                    <img src="/img/tabla/{{ $reporte_de_tractor->ProgramacionDeTractor->turno == 'MAÑANA' ? 'sol' : 'luna' }}.svg" alt="turno" width="25">
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-2 text-center">
                            <div>
                                <span class="font-medium">{{ $reporte_de_tractor->ProgramacionDeTractor->Lote->lote }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-2 text-center">
                            <div>
                                <span class="font-medium">{{ $reporte_de_tractor->ProgramacionDeTractor->labor->labor }}</span>
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
            {{ $reporte_de_tractores->links() }}
        </div>
</div>
