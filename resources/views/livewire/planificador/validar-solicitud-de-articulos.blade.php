<div>
    @if ($existe_pedido)
    <div style="display:flex; align-items:center;justify-content:center;margin-bottom:15px">
        <h1 class="text-2xl font-bold text-center">PEDIDO DE {{  strtoupper($mes_de_pedido)  }} </h1>
    </div>
    <div class="p-6" style="padding-left: 1rem; padding-right:1rem">
        <select class="form-control" id="id_implemento" style="width: 100%; height:2.5rem" wire:model='sede_id'>
            <option value="0" class="font-bold text-center text-md">Seleccione una sede</option>
            @foreach ($sedes as $sede)
            <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
            @endforeach
        </select>
    </div>
    @livewire('planificador.validar-solicitud-de-articulo.operarios', ['fecha_de_pedido' => $fecha_de_pedido,'sede_id' => $sede_id])
    @livewire('planificador.validar-solicitud-de-articulo.modal', ['fecha_de_pedido' => $fecha_de_pedido,'sede_id' => $sede_id])
    @endif
</div>
