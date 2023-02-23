<div>
    <x-jet-dialog-modal maxWidth="2xl" wire:model="open">
        <x-slot name="title">
            Pedido de {{ $operario }}
        </x-slot>
        <x-slot name="content">
            @if($operario_id > 0)
            <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2">
                <div class="py-2 bg-gray-200 rounded-md shadow-xl" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Implemento: </x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model="solicitud_id">
                        <option value="0">Seleccione una implemento</option>
                        @foreach ($solicitudes as $solicitud)
                            <option value="{{ $solicitud->id }}"> {{$solicitud->Implemento->ModeloDelImplemento->modelo_de_implemento}} {{ $solicitud->Implemento->numero  }} </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="solicitud_id"/>
                </div>

                <div class="py-4 mt-2 bg-{{ $monto_disponible > 0 ? 'green' : 'red' }}-500 rounded-md">
                    <h1 class="text-lg font-bold text-center text-white">Monto Disponible: S/.{{ $monto_disponible }}</h1>
                </div>
            </div>
                @if($solicitud_id > 0)
                    @livewire('planificador.validar-solicitud-de-articulo.material-nuevo.base', ['solicitud_id' => $solicitud_id])
                    @livewire('planificador.validar-solicitud-de-articulo.tabla', ['solicitud_id' => $solicitud_id,'tipo' => 'PENDIENTE','estado'=>$estado],key(1))
                    @livewire('planificador.validar-solicitud-de-articulo.tabla', ['solicitud_id' => $solicitud_id,'tipo' => 'VALIDADO','estado'=>$estado],key(2))
                    @livewire('planificador.validar-solicitud-de-articulo.tabla', ['solicitud_id' => $solicitud_id,'tipo' => 'RECHAZADO','estado'=>$estado],key(3))
                    @livewire('planificador.validar-solicitud-de-articulo.validar-material', ['estado' => $estado])
                @endif
            @endif
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
    @if ($solicitud_id > 0)
        @livewire('planificador.validar-solicitud-de-articulo.material-nuevo.modal', ['solicitud_id' => $solicitud_id])
        @livewire('planificador.validar-solicitud-de-articulo.material-nuevo.detalle')
    @endif
</div>
