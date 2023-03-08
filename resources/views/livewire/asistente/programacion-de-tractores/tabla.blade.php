<div>
    @if ($resumen_programaciones->count())
    <div class="grid items-center grid-cols-2 p-2 text-center bg-blue-800" wire:loading.remove>
        <div class="col-span-2 text-lg font-black text-white">
            FECHA : <span>{{ date_format(date_create($fecha),'d-m-Y') }} - SEMANA: {{ date_format(date_create($fecha),'W') }}</span>
        </div>
    </div>
    <table class="block min-w-full text-center border-collapse md:table" wire:loading.remove>
        <thead class="block md:table-header-group">
            <tr class="absolute block text-center border border-grey-500 md:border-none md:table-row -top-full md:top-auto -left-full md:left-auto md:relative">
                <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                    <span class="hidden sm:block">FUNDO</span>
                </th>
                <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                    <span class="hidden sm:block">LABOR</span>
                </th>
                <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                    <span class="hidden sm:block"># DE MAQUINAS</span>
                </th>
                <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                    <span class="hidden sm:block">SOLICITA</span>
                </th>
                <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                    <span class="hidden sm:block">TURNO</span>
                </th>
            </tr>
        </thead>
        <tbody class="block md:table-row-group">
            @foreach ($resumen_programaciones as $resumen_programacion)
                <tr style="cursor: pointer" class="block font-medium bg-white border border-red-500 md:border-none md:table-row">
                    <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                        <div>
                            <span class="inline-block font-bold md:hidden" style="width: 90px;padding-left: 0.4rem">
                                FUNDO :
                            </span>
                            <span class="font-medium">{{ $resumen_programacion->fundo }}</span>
                        </div>
                    </td>
                    <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                        <div>
                            <span class="inline-block font-bold md:hidden" style="width: 90px;padding-left: 0.4rem">
                                LABOR :
                            </span>
                            <span class="font-medium">{{ $resumen_programacion->labor }}</span>
                        </div>
                    </td>
                    <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                        <div>
                            <span class="inline-block font-bold md:hidden" style="width: 90px;padding-left: 0.4rem">
                                # MAQ. :
                            </span>
                            <span class="font-medium">{{ $resumen_programacion->numero_de_maquinas }}</span>
                        </div>
                    </td>
                    <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                        <div>
                            <span class="inline-block font-bold md:hidden" style="width: 90px;padding-left: 0.4rem">
                                SOLICITA :
                            </span>
                            <span class="font-medium">{{ $resumen_programacion->solicitante }}</span>
                        </div>
                    </td>
                    <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                        <div>
                            <span class="inline-block font-bold md:hidden" style="width: 90px;padding-left: 0.4rem">
                                TURNO :
                            </span>
                            <span class="font-medium">{{ $resumen_programacion->turno }}</span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-4 py-4" wire:loading.remove>
        {{ $resumen_programaciones->links() }}
    </div>
    @else
    <div class="px-6 py-4" wire:loading.remove>
        No existe ningún registro coincidente
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
