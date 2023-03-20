<div>
    <x-jet-dialog-modal wire:model='open' id="modal">
        <x-slot name="title">
            Registrar Personal
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 sm:grid-cols-2">

                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Sedes:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model.defer='sede_id'>
                    <option value="0">Seleccione una sede</option>
                    @foreach ($sedes as $sede)
                        <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                    @endforeach
                    </select>

                    <x-jet-input-error for="sede_id"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Código:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%" wire:model.defer="codigo"/>

                    <x-jet-input-error for="codigo"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>DNI:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%" wire:model.defer="dni"/>

                    <x-jet-input-error for="dni"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Nombre:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%" wire:model.defer="nombre"/>

                    <x-jet-input-error for="nombre"/>

                </div>

                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>¿Está activo?</x-jet-label>
                    <x-jet-input type="checkbox" style="height:40px;width: 100%" wire:model="is_active"/>

                    <x-jet-input-error for="is_active"/>

                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:loading.attr="disabled" wire:click="registrar()">
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
