<div>
    <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
        <select class="form-control" id="id_implemento" style="width: 100%" wire:model='tabla'>
            <option value="" class="font-bold text-center text-md">Seleccione una opción</option>
            <option value="tractor">Tractor</option>
            <option value="implemento">Implemento</option>
        </select>
    </div>
    @switch($tabla)
    @case('tractor')
        @livewire('planificador.importar-datos.tractor.base')
        @break
    @case('implemento')
    @livewire('planificador.importar-datos.implemento.base')
        @break
    @default

@endswitch
</div>
