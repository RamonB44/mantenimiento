<div>
    <div class="grid items-center grid-cols-1 bg-white md:grid-cols-2">
        <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
            <x-jet-label>Fecha:</x-jet-label>
            <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha"/>
        </div>
        <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
            <x-jet-label>Turno:</x-jet-label>
            <select class="form-select" style="width: 100%" wire:model='turno'>
                <option value="MAÑANA">DIA</option>
                <option>NOCHE</option>
            </select>
        </div>
        <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
            <x-jet-input type="text" style="height:40px;width: 100%" wire:model.lazy="search" placeholder="Escriba lo que desea buscar y presione enter"/>
        </div>
        <x-boton-crud accion="$emit('excel')" color="green">EXCEL</x-boton-crud>
    </div>
    @if ($total_de_programaciones == 0)
    <div class="items-center p-2 text-center bg-amber-600" wire:loading.remove>
        <div class="col-span-2 text-lg font-black text-white">
            NADA PROGRAMADO AÚN
        </div>
    </div>
    @elseif ($total_de_programaciones == $reporte_de_tractores->count())
    <div class="items-center p-2 text-center bg-green-600" wire:loading.remove>
        <div class="col-span-2 text-lg font-black text-white">
            REPORTE COMPLETO
        </div>
    </div>
    @else
    <x-boton-crud color="red" accion="$emit('abrirModal',{{ $sede_id }},'{{ $fecha }}','{{ $turno }}')">Faltan reportar {{ $total_de_programaciones - $reporte_de_tractores->count() }} programaciones de {{ $total_de_programaciones }}</x-boton-crud>
    @endif
    @if ($reporte_de_tractores->count())
        <table class="block min-w-full text-center border-collapse md:table" wire:loading.remove>
            <thead class="block md:table-header-group">
                <tr class="absolute block text-center border border-grey-500 md:border-none md:table-row -top-full md:top-auto -left-full md:left-auto md:relative">
                    <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                        <span class="hidden sm:block">Correlativo</span>
                    </th>
                    <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                        <span class="hidden sm:block">Tractorista</span>
                    </th>
                    <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                        <span class="hidden sm:block">Tractor</span>
                    </th>
                    <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                        <span class="hidden sm:block">Horometro</span>
                    </th>
                    <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                        <span class="hidden sm:block">Implementos</span>
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
                @foreach ($reporte_de_tractores as $reporte_de_tractor)
                    <tr style="cursor: pointer" class="block font-medium bg-white border border-red-500 md:border-none md:table-row">
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/correlativo.svg" alt="tractortista" width="25">
                                </span>
                                <span class="font-medium">N° {{ $reporte_de_tractor->correlativo }}</span>
                            </div>
                        </td>
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/tractorista.png" alt="tractortista" width="25">
                                </span>
                                <span class="font-medium">{{ $reporte_de_tractor->ProgramacionDeTractor->Tractorista->name }}</span>
                            </div>
                        </td>
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/tractor.svg" alt="tractor" width="25">
                                </span>
                                <span class="font-medium">
                                    @if ($reporte_de_tractor->ProgramacionDeTractor->Tractor == null)
                                        Autopropulsado
                                    @else
                                    {{ $reporte_de_tractor->ProgramacionDeTractor->Tractor->ModeloDeTractor->modelo_de_tractor }} {{ $reporte_de_tractor->ProgramacionDeTractor->Tractor->numero }}
                                    @endif
                                </span>
                            </div>
                        </td><td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/turno.svg" alt="tractor" width="25">
                                </span>
                                <span class="font-medium">{{ $reporte_de_tractor->horometro_inicial }} - {{ $reporte_de_tractor->horometro_final }}</span>
                            </div>
                        </td>
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/implemento.png" alt="implemento" width="25">
                                </span>
                                <span class="font-medium">
                                    @foreach ($reporte_de_tractor->ProgramacionDeTractor->Implementos as $implemento_reporte)
                                        {{ $implemento_reporte->Implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implemento_reporte->Implemento->numero }},
                                    @endforeach
                                </span>
                            </div>
                        </td>
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/lote.png" alt="lote" width="25">
                                </span>
                                <span class="absolute font-medium md:relative">
                                    <img class="ml-2 md:hidden" src="/img/frutas/{{ strtolower($reporte_de_tractor->ProgramacionDeTractor->Lote->Cultivo->cultivo) }}.png" align="right" alt="cultivo" width="25">{{ $reporte_de_tractor->ProgramacionDeTractor->Lote->Fundo->fundo }} {{ $reporte_de_tractor->ProgramacionDeTractor->Lote->lote }}
                                </span>
                                <div class="items-center justify-center hidden md:flex">
                                    <img class="ml-2" src="/img/frutas/{{ strtolower($reporte_de_tractor->ProgramacionDeTractor->Lote->Cultivo->cultivo) }}.png" alt="cultivo" width="25">
                                </div>
                            </div>
                        </td>
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/labor.svg" alt="labor" width="25">
                                </span>
                                <span class="font-medium">{{ $reporte_de_tractor->ProgramacionDeTractor->labor->labor }}</span>
                            </div>
                        </td>
                        <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                            <div>
                                <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                    <img src="/img/tabla/solicitante.png" alt="labor" width="25">
                                </span>
                                <span class="font-medium">{{ $reporte_de_tractor->ProgramacionDeTractor->solicitante == null ? 'NO REGISTRADO' : $reporte_de_tractor->ProgramacionDeTractor->Solicitante->name }}</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="align-items:center;justify-content:center;margin-bottom:15px" wire:loading.flex>
            <div class="text-center">
                <h1 class="text-4xl font-bold">
                    CARGANDO DATOS...
                </h1>
            </div>
        </div>
    @else
        <div class="px-6 py-4 text-2xl font-black">
           Ningún registro coincidente
        </div>
    @endif
</div>
