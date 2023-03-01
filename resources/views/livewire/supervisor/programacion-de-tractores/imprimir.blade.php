<div>
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Imprimir Programación de tractores
        </x-slot>
        <x-slot name="content">
            <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                <x-jet-label>Día:</x-jet-label>
                <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha"/>

                <x-jet-input-error for="fecha"/>

            </div>
            <div class="grid items-center grid-cols-1 p-6 bg-white sm:grid-cols-2">
                <x-boton-crud accion="imprimirProgramacion" wire:loading.attr="disabled" color="gray">
                    Imprimir Programación
                </x-boton-crud>
                <x-boton-crud accion="imprimirRutinario" wire:loading.attr="disabled" color="gray">
                    Imprimir Rutinario
                </x-boton-crud>

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
