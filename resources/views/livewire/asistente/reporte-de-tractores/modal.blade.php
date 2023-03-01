<div>
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Registrar Reporte de tractores
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 sm:grid-cols-2">
            @if($accion == "crear")
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Día:</x-jet-label>
                    <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha"/>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Turno:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='turno'>
                        <option>MAÑANA</option>
                        <option>NOCHE</option>
                    </select>
                </div>
                <div class="py-2 cols-span-1 sm:col-span-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Programacion:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='programacion_id'>
                        <option value="0">Seleccione una opción</option>
                    @foreach ($programaciones as $programacion)
                        <option value="{{ $programacion->id }}">Tractorista: {{ $programacion->Tractorista->name  }} |
                            @if ($programacion->Tractor == null)
                            Autopropulsado
                            @else
                            Tractor {{ $programacion->Tractor->ModeloDeTractor->modelo_de_tractor }} {{ $programacion->Tractor->numero }}
                            @endif
                        </option>
                    @endforeach
                    </select>
                </div>
            @endif
            @if ($programacion_id > 0)
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Fundo:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%" value="{{$fundo}}" disabled/>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Lote:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%" value="{{$lote}}" disabled/>
                </div>
                <div class="col-span-1 py-2 sm:col-span-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Correlativo:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%" wire:model.defer="correlativo" id="correlativo"/>

                    <x-jet-input-error for="correlativo"/>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Tractorista:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%" value="{{$tractorista}}" disabled/>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Tractor:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%" value="{{$tractor}}" disabled/>
                </div>

                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Horometro Inicial:</x-jet-label>
                    <x-jet-input type="number" style="height:40px;width: 100%" wire:model.defer="horometro_inicial" disabled="{{ $deshabilitar_horometro_inicial }}"/>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Horometro Final:</x-jet-label>
                    <x-jet-input type="number" style="height:40px;width: 100%" wire:model.defer="horometro_final"/>

                    <x-jet-input-error for="horometro_final"/>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Implemento:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%" value="{{$implemento}}" disabled/>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Labor:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%" value="{{$labor}}" disabled/>
                </div>
            @endif
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
