<div>
    <x-jet-dialog-modal wire:model='open' id="modal" maxWidth="2xl" color="{{ $turno == 'MAÑANA' ? 'amber' : 'blue' }}">
        <x-slot name="title">
            {{ ucfirst($fecha_programacion) }}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>.</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='fecha'>
                        <option value="{{ $yesterday }}">AYER</option>
                        <option value="{{ $today }}">HOY</option>
                        <option value="{{ $tomorrow }}">MAÑANA</option>
                    </select>
                    <x-jet-input-error for="fecha"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Turno:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='turno'>
                        <option value="MAÑANA">DIA</option>
                        <option>NOCHE</option>
                    </select>

                    <x-jet-input-error for="turno"/>

                </div>
                <div class="py-2 md:col-span-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Solicita:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model.defer='solicita'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($solicitantes as $solicitante)
                            <option value="{{ $solicitante->id }}">{{ $solicitante->name }}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="solicita"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Fundo:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='fundo'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($fundos as $fundo)
                            <option value="{{ $fundo->id }}">{{ $fundo->fundo }}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="fundo"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem" wire:loading.remove>
                    <x-jet-label>Lote:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model.defer='lote'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($lotes as $lote)
                            <option value="{{ $lote->id }}">{{ $lote->lote }} - {{ $lote->Cultivo->cultivo }}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="lote"/>

                </div>
                <div class="p-6 text-2xl text-center" wire:loading.flex>
                    Cargando...
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem" wire:loading.remove>
                    <x-jet-label>Tractorista:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%;cursor:pointer" value="{{ $nombre_tractorista }}" readonly wire:click="$emitTo('supervisor.programacion-de-tractores.lista-tractoristas','abrirModal','{{ $fecha }}','{{ $turno }}','{{ $programacion_id }}')"/>


                    <x-jet-input-error for="tractorista"/>

                </div>
                <div class="p-6 text-2xl text-center" wire:loading.flex>
                    Cargando...
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Tractor:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%;cursor:pointer" value="{{ $nombre_tractor }}" readonly wire:click="$emitTo('supervisor.programacion-de-tractores.lista-tractores','abrirModal','{{ $fecha }}','{{ $turno }}','{{ $programacion_id }}')"/>

                    <x-jet-input-error for="tractor"/>

                </div>
                <div class="col-span-1 py-2 sm:col-span-2" style="padding-left: 1rem; padding-right:1rem" wire:loading.remove>
                    <x-jet-label>Implemento:</x-jet-label>
                    <x-jet-input type="text" style="height:40px;width: 100%;cursor:pointer" value="{{ $nombre_implemento }}" readonly wire:click="$emitTo('supervisor.programacion-de-tractores.lista-implementos','abrirModal','{{ $fecha }}','{{ $turno }}','{{ $programacion_id }}')"/>

                    <x-jet-input-error for="implemento"/>

                </div>
                <div class="p-6 text-2xl text-center" wire:loading.flex>
                    Cargando...
                </div>
                <div class="py-2 md:col-span-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Labor:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model.defer='labor'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($labores as $labor)
                            <option value="{{ $labor->id }}">{{ $labor->labor }}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="labor"/>

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
