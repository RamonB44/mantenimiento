<div>
    @if ($sede_id > 0)
        @if ($operarios_pendientes->count() > 0)
        <div style="display:flex; align-items:center;justify-content:center;margin-bottom:15px">
            <h1 class="text-2xl font-bold text-center">PEDIDOS PENDIENTES</h1>
        </div>
        <div class="grid grid-cols-1 gap-4 p-6 mt-4 sm:grid-cols-4">
            @foreach ($operarios_pendientes as $operario_pendiente)
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center text-center">
                    <h5 class="mb-1 text-lg font-medium text-gray-900 dark:text-white">{{ $operario_pendiente->name }}</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Operario</span>
                    <div class="flex mt-4 space-x-3 lg:mt-6">
                        <button wire:click="$emit('mostrarPedidos',{{$operario_pendiente->id}},'{{$operario_pendiente->name}}','CERRADO')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ver Pedido</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        @if ($operarios_validados->count() > 0)
        <div style="display:flex; align-items:center;justify-content:center;margin-bottom:15px">
            <h1 class="text-2xl font-bold text-center">PEDIDOS VALIDADOS</h1>
        </div>
        <div class="grid grid-cols-1 gap-4 p-6 mt-4 sm:grid-cols-4">
            @foreach ($operarios_validados as $operario_validado)
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center text-center">
                    <h5 class="mb-1 text-lg font-medium text-gray-900 dark:text-white">{{ $operario_validado->name }}</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Operario</span>
                    <div class="flex mt-4 space-x-3 lg:mt-6">
                        <button wire:click="$emit('mostrarPedidos',{{$operario_validado->id}},'{{$operario_validado->name}}','VALIDADO')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ver Pedido</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        @livewire('planificador.validar-solicitud-de-articulo.modal', ['fecha_de_pedido' => $fecha_de_pedido,'sede_id' => $sede_id])
    @endif
</div>
