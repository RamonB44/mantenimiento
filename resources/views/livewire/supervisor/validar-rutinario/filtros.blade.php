<div>
    <x-jet-dialog-modal wire:model='open' class="bg-grey-500">
        <x-slot name="title">
            Filtrar Programación de tractores
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Día:</x-jet-label>
                    <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha"/>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Turno:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='turno'>
                        <option value="">Seleccione un turno</option>
                        <option>MAÑANA</option>
                        <option>NOCHE</option>
                    </select>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Operador:</x-jet-label>
                    <select id="operario" class="form-select" style="width: 100%" wire:model='operarioid'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($operarios as $operario)
                            <option value="{{ $operario->id }}">{{ $operario->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Implemento:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='implementoid'>
                        <option value="0">Seleccione una opción</option>
                    @foreach ($implementos as $implemento)
                        <option value="{{ $implemento->id }}">{{ $implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implemento->numero }}</option>
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
