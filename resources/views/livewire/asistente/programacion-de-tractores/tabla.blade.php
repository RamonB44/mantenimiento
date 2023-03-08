<div>
    @if ($resumen_programaciones->count())
    <div class="grid items-center grid-cols-2 p-2 text-center bg-blue-800" wire:loading.remove>
        <div class="col-span-2 text-lg font-black text-white">
            FECHA : <span>{{ date_format(date_create($fecha),'d-m-Y') }} - SEMANA: {{ date_format(date_create($fecha),'W') }}</span>
        </div>
    </div>
    <table class="w-full min-w-max" wire:loading.remove>
        <thead>
            <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                <th class="py-3 text-center">
                    <span>FUNDO</span>
                </th>
                <th class="py-3 text-center">
                    <span>LABOR</span>
                </th>
                <th class="py-3 text-center">
                    <span># de MÁQUINAS </span>
                </th>
                <th class="py-3 text-center">
                    <span>SOLICITA</span>
                </th>
                <th class="py-3 text-center">
                    <span>TURNO</span>
                </th>
            </tr>
        </thead>
        <tbody class="text-sm font-light text-gray-600">
            @foreach ($resumen_programaciones as $resumen_programacion)
                <tr class="border-b border-gray-200 unselected">
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-medium">{{$resumen_programacion->fundo}} </span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-medium">{{$resumen_programacion->labor}} </span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-medium">{{$resumen_programacion->numero_de_maquinas}} </span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-medium">{{$resumen_programacion->solicitante}} </span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-medium">{{$resumen_programacion->turno}} </span>
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
