<div>
    <x-jet-dialog-modal maxWidth="2xl" wire:model="open">
        <x-slot name="title">
            Resumen de pedido
        </x-slot>
        <x-slot name="content">
        <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2">
            <div class="py-2 bg-gray-200 rounded-md shadow-xl" style="padding-left: 1rem; padding-right:1rem">
                <x-jet-label>Centro de Costo: </x-jet-label>
                <select class="form-select" style="width: 100%" wire:model="ceco_id">
                    <option value="0">Seleccione un centro de costo</option>
                    @foreach ($cecos as $ceco)
                        <option value="{{ $ceco->id }}"> {{ $ceco->codigo }} {{ $ceco->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <x-boton-crud accion="imprimir" color="red">Imprimir</x-boton-crud>
        </div>
        @livewire('planificador.resumen-de-pedido.tabla', ['fecha_de_pedido'=>$fecha_de_pedido,'sede_id' => $sede_id])
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
