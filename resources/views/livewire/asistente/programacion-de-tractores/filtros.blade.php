<div>
    <x-boton-crud colspan="2" colspansm="4" accion="$set('open',true)" color="indigo">Filtros</x-boton-crud>
    <x-jet-dialog-modal wire:model='open' class="bg-grey-500">
        <x-slot name="title">
            Filtrar Resumen de Programación
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Fecha:</x-jet-label>
                    <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model.defer="fecha"/>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Turno:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model.defer='turno'>
                        <option value="">Seleccione un turno</option>
                        <option value="MAÑANA">DIA</option>
                        <option>NOCHE</option>
                    </select>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Fundo:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model.defer='fundo_id'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($fundos as $fundo)
                            <option value="{{ $fundo->id }}">{{ $fundo->fundo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Labor:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model.defer='labor_id'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($labores as $labor)
                            <option value="{{ $labor->id }}">{{ $labor->labor }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Labor:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model.defer='solicitante_id'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($solicitantes as $solicitante)
                            <option value="{{ $labor->id }}">{{ $labor->labor }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:loading.attr="disabled" wire:click="filtrar">
                Filtrar
            </x-jet-button>
            <div wire:loading wire:target="filtrar">
                Filtrando...
            </div>
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
