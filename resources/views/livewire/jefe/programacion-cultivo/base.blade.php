<div class="w-full">
    <div class="grid grid-cols-1 {{ $sede_id > 0 ? 'sm:grid-cols-3' : 'sm:grid-cols-1' }} py-2">
        <div style="padding-left: 1rem; padding-right:1rem">
            <x-jet-label>Sede:</x-jet-label>
            <select class="form-control" id="id_implemento" style="width: 100%" wire:model='sede_id'>
                <option value="0" class="font-bold text-center text-md">Seleccione una sede</option>
                @foreach ($sedes as $sede)
                <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                @endforeach
            </select>
        </div>
        @if ($sede_id > 0)
        <div style="padding-left: 1rem; padding-right:1rem">
            <x-jet-label>Fecha:</x-jet-label>
            <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha"/>
        </div>
        <div style="padding-left: 1rem; padding-right:1rem">
            <x-jet-label>Turno:</x-jet-label>
            <select class="form-select" style="width: 100%" wire:model='turno'>
                <option>MAÑANA</option>
                <option>NOCHE</option>
            </select>
        </div>
        @endif
    </div>
    @if ($sede_id > 0)
    <div class="grid grid-cols-1 {{ $supervisor_id > 0 ? 'sm:grid-cols-2' : 'sm:grid-cols-1' }}" wire:loading.remove>
        <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
            <select class="form-control" style="width: 100%" wire:model='supervisor_id'>
                <option value="0" class="font-bold text-center text-md">Seleccione el supervisor</option>
                @foreach ($supervisores as $supervisor)
                <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                @endforeach
            </select>
        </div>
        @if ($supervisor_id > 0)
        <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
            <select class="form-control" style="width: 100%" wire:model='cultivo_fundo_id'>
                <option value="0,0" class="font-bold text-center text-md">Seleccione el cultivo</option>
                @foreach ($cultivo_fundos as $cultivo_fundo)
                <option value="{{ $cultivo_fundo->cultivo_id }},{{ $cultivo_fundo->fundo_id ?? '0' }}">{{ $cultivo_fundo->cultivo }}{{ isset($cultivo_fundo->fundo) ? ' - '.$cultivo_fundo->fundo : '' }}</option>
                @endforeach
            </select>
        </div>
        @endif
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2" wire:loading.remove>
        <div class="flex-1 p-4 bg-white border rounded shadow h-96 {{ $cultivo_fundo_id != '0,0' ? 'col-span-2' : '' }}">
            <livewire:livewire-pie-chart
                key="{{ $pieChartModel->reactiveKey() }}"
                :pie-chart-model="$pieChartModel"
            />
        </div>
        @if ($cultivo_fundo_id == "0,0")
        <div class="flex-1 p-4 bg-white border rounded shadow h-96">
            <div class="items-center p-2 text-center bg-blue-800 md:hidden" wire:loading.remove>
                <div class="text-lg font-black text-white">
                    RESUMEN DE TRACTORES</span>
                </div>
            </div>
            <table class="block min-w-full text-center border-collapse md:table" wire:loading.remove>
                <thead class="block md:table-header-group">
                    <tr class="absolute block text-center border border-grey-500 md:border-none md:table-row -top-full md:top-auto -left-full md:left-auto md:relative">
                        <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                            <span class="hidden sm:block">
                                <div class="items-center justify-center hidden md:flex">
                                    <img class="ml-2" src="/img/tabla/cultivo.png" alt="cultivo" width="25">
                                </div>
                            </span>
                        </th>
                        <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                            <span class="hidden sm:block">
                                <div class="items-center justify-center hidden md:flex">
                                    <img class="ml-2" src="/img/tabla/tractor.svg" alt="tractor" width="25">
                                </div>
                            </span>
                        </th>
                        <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                            <span class="hidden sm:block">
                                <div class="items-center justify-center hidden md:flex">
                                    <img class="ml-2" src="/img/tabla/programado.png" alt="programado" width="25">
                                </div>
                            </span>
                        </th>
                        <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                            <span class="hidden sm:block">
                                <div class="items-center justify-center hidden md:flex">
                                    <img class="ml-2" src="/img/tabla/no-programado.png" alt="no-programado" width="25">
                                </div>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group">
                        <tr style="cursor: pointer" class="block font-medium bg-white border border-red-500 md:border-none md:table-row">
                            <td class="block p-2 text-left md:text-center md:border md:border-grey-500 md:table-cell">
                                <div>
                                    <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                        <img src="/img/tabla/cultivo.png" alt="lote" width="25">
                                    </span>
                                    <span class="absolute font-medium md:relative">
                                        <img class="ml-2 md:hidden" src="/img/frutas/{{ strtolower('ARANDANOS') }}.png" align="right" alt="cultivo" width="25">STA. MARGARITA VID
                                    </span>
                                    <div class="items-center justify-center hidden md:flex">
                                        <img class="ml-2" src="/img/frutas/{{ strtolower('ARANDANOS') }}.png" alt="cultivo" width="25">
                                    </div>
                                </div>
                            </td>
                            <td class="block p-2 text-left md:text-center md:border md:border-grey-500 md:table-cell">
                                <div>
                                    <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                        <img src="/img/tabla/tractor.svg" alt="tractor" width="25">
                                    </span>
                                    <span class="font-medium">
                                        12
                                    </span>
                                </div>
                            </td>
                            <td class="block p-2 text-left md:text-center md:border md:border-grey-500 md:table-cell">
                                <div>
                                    <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                        <img src="/img/tabla/programado.png" alt="programado" width="25">
                                    </span>
                                    <span class="font-medium">
                                        9
                                    </span>
                                </div>
                            </td>
                            <td class="block p-2 text-left md:text-center md:border md:border-grey-500 md:table-cell">
                                <div>
                                    <span class="inline-block font-bold md:hidden" style="width: 50px;padding-left: 0.4rem">
                                        <img src="/img/tabla/no-programado.png" alt="no-programado" width="25">
                                    </span>
                                    <span class="font-medium">
                                        3
                                    </span>
                                </div>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
        @endif
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
