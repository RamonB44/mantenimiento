<div>
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Exportar Reporte de tractores
        </x-slot>
        <x-slot name="content">
            <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                <x-jet-label>Día:</x-jet-label>
                <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:loading.attr="disabled" wire:click="exportar()">
                Imprimir Programación
            </x-jet-button>
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cancelar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
