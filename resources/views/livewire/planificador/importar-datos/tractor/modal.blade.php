<div>
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Registrar Tractores
        </x-slot>
        <x-slot name="content">
            <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                <x-jet-label>Sede:</x-jet-label>
                <select class="form-select" style="width: 100%" wire:model='sede_id'>
                    <option value="0">Seleccione una opción</option>
                    @foreach ($sedes as $sede)
                        <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                    @endforeach
                </select>

                <x-jet-input-error for="sede_id"/>

            </div>
            <div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Modelo de Tractor:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%" wire:model.defer="modelo_de_tractor"/>

                    <x-jet-input-error for="modelo_de_tractor"/>

                </div>
            </div>
            <div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Numero:</x-jet-label>
                    <x-jet-input type="number" style="height:40px;width: 100%" wire:model.defer="numero"/>

                    <x-jet-input-error for="numero"/>

                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:loading.attr="disabled" wire:click="registrar">
                Guardar
            </x-jet-button>
            <div wire:loading wire:target="registrar">
                Registrando...
            </div>
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
