<div>
    @if ($existe_pedido)
    <div style="display:flex; align-items:center;justify-content:center;margin-bottom:15px">
        <h1 class="text-2xl font-bold text-center">PEDIDO DE {{  strtoupper($mes_de_pedido)  }} </h1>
    </div>
    <div class="grid grid-cols-1 {{ $sede_id > 0 ? 'sm:grid-cols-2' : 'sm:grid-cols-1' }}">
        <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
            <select class="form-control" id="id_implemento" style="width: 100%" wire:model='sede_id'>
                <option value="0" class="font-bold text-center text-md">Seleccione una sede</option>
                @foreach ($sedes as $sede)
                <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                @endforeach
            </select>
        </div>
        @if ($sede_id > 0)
        <x-boton-crud accion="mostrar_resumen" color="cyan">Mostrar Resumen</x-boton-crud>
        @endif
    </div>
    @livewire('planificador.validar-solicitud-de-articulo.operarios', ['fecha_de_pedido' => $fecha_de_pedido,'sede_id' => $sede_id])
    @else
    <div style="display:flex; align-items:center;justify-content:center;margin-bottom:15px">
        <h1 class="text-4xl font-bold">NO HAY PEDIDOS PARA VALIDAR</h1>
    </div>
    <x-boton-crud accion="" color="cyan">Revisar pedidos anteriores</x-boton-crud>
    @endif
</div>
