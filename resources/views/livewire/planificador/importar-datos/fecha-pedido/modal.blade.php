<div>
    <x-jet-dialog-modal wire:model='open' id="modal" maxWidth="2xl">
        <x-slot name="title">
            Abrir pedido
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Fecha de apertura</x-jet-label>
                    <x-jet-input type="date" min="2023-03-01" style="height:40px;width: 100%" wire:model="fecha_de_apertura"/>

                    <x-jet-input-error for="fecha_apertura"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Fecha de cierre</x-jet-label>
                    <x-jet-input type="date" min="2023-03-01" style="height:40px;width: 100%" wire:model="fecha_de_cierre"/>

                    <x-jet-input-error for="fecha_de_cierre"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Fecha de pedido</x-jet-label>
                    <x-jet-input type="date" min="2023-03-01" style="height:40px;width: 100%" wire:model="fecha_de_pedido"/>

                    <x-jet-input-error for="fecha_de_pedido"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Fecha de llegada</x-jet-label>
                    <x-jet-input type="date" min="2023-03-01" style="height:40px;width: 100%" wire:model="fecha_de_llegada"/>

                    <x-jet-input-error for="fecha_de_llegada"/>

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
