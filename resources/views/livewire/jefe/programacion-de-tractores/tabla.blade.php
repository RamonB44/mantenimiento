<div>
    @if ($programacion_de_tractores->count())
        @if ($total_tractores > 0)
        <div class="grid items-center grid-cols-2 p-2 text-center bg-blue-800" wire:loading.remove>
            <div class="col-span-2 text-lg font-black text-white">
                FECHA : <span>
                    {{ date_format(date_create($fecha_inicial),'d-m-Y') }}
                    @if ($fecha_inicial != $fecha_final)
                        - {{ date_format(date_create($fecha_final),'d-m-Y') }}
                    @endif
                </span>
            </div>
            <div class="text-lg font-black text-white">
                TRACTORES : <span>{{ $total_tractores }}</span>
            </div>
            <div class="text-lg font-bold text-white">
                IMPLEMENTOS : <span>{{ $total_implementos }}</span>
            </div>
        </div>
        @endif
        <table class="block min-w-full text-center border-collapse md:table" wire:loading.remove>
            <thead class="block md:table-header-group">
                <tr class="absolute block text-center border border-grey-500 md:border-none md:table-row -top-full md:top-auto -left-full md:left-auto md:relative">
                    <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                        <span class="hidden sm:block">Tractorista</span>
                    </th>
                    <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                        <span class="hidden sm:block">Tractor</span>
                    </th>
                    <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                        <span class="hidden sm:block">Implementos</span>
                    </th>
                    <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                        <span class="hidden sm:block">Día</span>
                    </th>
                    <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                        <span class="hidden sm:block">Lote</span>
                    </th>
                    <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                        <span class="hidden sm:block">Labor</span>
                    </th>
                    <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                        <span class="hidden sm:block">Solicitante</span>
                    </th>
                </tr>
            </thead>
            <tbody class="block md:table-row-group">
                @foreach ($programacion_de_tractores as $programacion_de_tractor)
                    <tr class="block font-medium bg-white border border-red-500 md:border-none md:table-row {{ $programacion_de_tractor->supervisor != $programacion_de_tractor->Lote->encargado ? 'bg-amber-200' : 'bg-white' }}">
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/tractorista.png" alt="tractortista" width="25">
                                </span>
                                <span class="font-medium">{{ $programacion_de_tractor->Tractorista->name }}</span>
                            </div>
                        </td>
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/tractor.svg" alt="tractor" width="25">
                                </span>
                                <span class="font-medium">
                                    @if ($programacion_de_tractor->Tractor == null)
                                        Autopropulsado
                                    @else
                                    {{ $programacion_de_tractor->Tractor->ModeloDeTractor->modelo_de_tractor }} {{ $programacion_de_tractor->Tractor->numero }}
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/implemento.png" alt="implemento" width="25">
                                </span>
                                <span class="font-medium">
                                    @foreach ($programacion_de_tractor->Implementos as $implemento_programacion)
                                        {{ $implemento_programacion->Implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implemento_programacion->Implemento->numero }},
                                    @endforeach
                                </span>
                            </div>
                        </td>
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/fecha.svg" alt="fecha" width="25">
                                </span>
                                <span class="absolute font-medium md:relative">
                                    <img class="ml-2 md:hidden" src="/img/tabla/{{ $programacion_de_tractor->turno == 'MAÑANA' ? 'sol' : 'luna' }}.svg" align="right" alt="turno" width="25">{{ date_format(date_create($programacion_de_tractor->fecha),'d-m-Y') }}
                                </span>
                                <div class="items-center justify-center hidden md:flex">
                                    <img src="/img/tabla/{{ $programacion_de_tractor->turno == 'MAÑANA' ? 'sol' : 'luna' }}.svg" alt="turno" width="25">
                                </div>
                            </div>
                        </td>
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/lote.png" alt="lote" width="25">
                                </span>
                                <span class="absolute font-medium md:relative">
                                    <img class="ml-2 md:hidden" src="/img/frutas/{{ strtolower($programacion_de_tractor->Lote->Cultivo->cultivo) }}.png" align="right" alt="cultivo" width="25">{{ $programacion_de_tractor->Lote->Fundo->fundo }} {{ $programacion_de_tractor->Lote->lote }}
                                </span>
                                <div class="items-center justify-center hidden md:flex">
                                    <img class="ml-2" src="/img/frutas/{{ strtolower($programacion_de_tractor->Lote->Cultivo->cultivo) }}.png" alt="cultivo" width="25">
                                </div>
                            </div>
                        </td>
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/labor.svg" alt="labor" width="25">
                                </span>
                                <span class="font-medium">{{ $programacion_de_tractor->labor->labor }}</span>
                            </div>
                        </td>
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/solicitante.png" alt="labor" width="25">
                                </span>
                                <span class="font-medium">{{ $programacion_de_tractor->solicitante == null ? 'NO REGISTRADO' : $programacion_de_tractor->Solicitante->name }}</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-4 py-4" wire:loading.remove>
            {{ $programacion_de_tractores->links() }}
        </div>
    @else
        <div class="px-6 py-4">
            No existe ningún registro coincidente
            {{ $fecha_inicial }}
        </div>
    @endif
    <div style="align-items:center;justify-content:center;margin-bottom:15px" wire:loading.flex>
        <div class="text-center">
            <h1 class="text-4xl font-bold">
                CARGANDO DATOS...
            </h1>
        </div>
    </div>
</div>
