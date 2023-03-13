<div>
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Importar Materiales
        </x-slot>
        <x-slot name="content">

            <div class="grid items-center grid-cols-1 p-6 bg-white sm:grid-cols-2">
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Pedido:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model.defer='solicita'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($pedidos as $pedido)
                            <option value="{{ $pedido->id }}">{{ $pedido->name }}</option>
                        @endforeach
                    </select>

                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
