<div>
    <x-jet-dialog-modal maxWidth="2xl" wire:model="open">
        <x-slot name="title">
            Pedido de {{ $operario }}
        </x-slot>
        <x-slot name="content">
            @if($operario_id > 0)
        <!------------ Boton para materiales nuevos----------------------->
            <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2">
                <div class="py-2 bg-gray-200 rounded-md shadow-xl" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Implemento: </x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model="implementoid">
                        <option value="0">Seleccione una implemento</option>
                        @foreach ($implementos as $implemento)
                            <option value="{{ $implemento->id }}"> {{$implemento->ModeloDelImplemento->modelo_de_implemento}} {{ $implemento->numero  }} </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="implementoid"/>
                </div>

                <div class="py-4 mt-2 bg-red-500 rounded-md">
                    <h1 class="text-lg font-bold text-center text-white">Monto Disponible: S/.{{ $monto_disponible }}</h1>
                </div>
            </div>
                @if($implementoid > 0)
                    @livewire('planificador.validar-solicitud-de-articulo.tabla', ['implemento_id' => $implementoid,'fecha_de_pedido'=>$fecha_de_pedido,'operario_id' => $operario_id,'tipo' => 'ACEPTADO'])
                    @livewire('planificador.validar-solicitud-de-articulo.tabla', ['implemento_id' => $implementoid,'fecha_de_pedido'=>$fecha_de_pedido,'operario_id' => $operario_id,'tipo' => 'VALIDADO'])
                    @livewire('planificador.validar-solicitud-de-articulo.tabla', ['implemento_id' => $implementoid,'fecha_de_pedido'=>$fecha_de_pedido,'operario_id' => $operario_id,'tipo' => 'RECHAZADO'])
                    @livewire('planificador.validar-solicitud-de-articulo.validar-material')
                @endif
            @endif
        </x-slot>
        <x-slot name="footer">
            @if($implementoid > 0)
                <button wire:loading.attr="disabled" wire:click="validarSolicitudPedido()" style="width: 200px" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-700">
                    Validar
                </button>
                <button wire:loading.attr="disabled" wire:click="rechazarSolicitudPedido()" style="width: 200px" class="px-4 py-2 ml-2 text-white bg-red-500 rounded-md hover:bg-red-700">
                    Rechazar
                </button>
            @endif
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cancelar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
