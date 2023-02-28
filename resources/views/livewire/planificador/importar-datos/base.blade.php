<div>
    <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
        <select class="form-control" id="id_implemento" style="width: 100%" wire:model='tabla'>
            <option value="" class="font-bold text-center text-md">Seleccione una opción</option>
            @foreach ($tablas as $item)
            <option value="{{ $item }}">{{ ucfirst($item) }}</option>
            @endforeach

        </select>
    </div>
    @switch($tabla)
    @case('tractor')
        @livewire('planificador.importar-datos.tractor.base')
        @break
    @case('implemento')
    @livewire('planificador.importar-datos.implemento.base')
        @break
    @case('lote')
    @livewire('planificador.importar-datos.lote.base')
        @break
    @case('usuario')
    @livewire('planificador.importar-datos.usuario.base')
        @break
    @case('articulo')
    @livewire('planificador.importar-datos.articulo.base')
        @break
    @case('centro de costo')
    @livewire('planificador.importar-datos.ceco.base')
        @break
    @case('epp')
    @livewire('planificador.importar-datos.epp.base')
        @break
    @case('labor')
    @livewire('planificador.importar-datos.labor.base')
        @break
    @case('rutinario')
    @livewire('planificador.importar-datos.rutinario.base')
        @break
    @case('fecha pedidos')
    @livewire('planificador.importar-datos.fecha-pedido.base')
        @break
    @default

@endswitch
</div>
