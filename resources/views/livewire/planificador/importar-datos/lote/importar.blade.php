<div>
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Importar Lotes
        </x-slot>
        <x-slot name="content">
            <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                <x-jet-label>Archivo excel:</x-jet-label>
                <input type="file" style="height:40px;width: 100%" wire:model="archivo"/>

                <x-jet-input-error for="archivo"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:loading.attr="disabled" wire:click="importar">
                Importar
            </x-jet-button>
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cancelar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
