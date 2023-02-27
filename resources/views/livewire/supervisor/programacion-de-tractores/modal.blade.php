<div>
    <x-jet-dialog-modal wire:model='open' id="modal" maxWidth="2xl">
        <x-slot name="title">
            Registrar Programación de tractores
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Día:</x-jet-label>
                    <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha"/>

                    <x-jet-input-error for="fecha"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Turno:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='turno'>
                        <option>MAÑANA</option>
                        <option>NOCHE</option>
                    </select>

                    <x-jet-input-error for="turno"/>

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
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Lote:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='lote'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($lotes as $lote)
                            <option value="{{ $lote->id }}">{{ $lote->lote }}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="lote"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Operador:</x-jet-label>
                    <select id="tractorista" class="form-select" style="width: 100%" wire:model.defer='tractorista'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($tractoristas as $tractorista)
                            <option value="{{ $tractorista->id }}">{{ $tractorista->name }}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="tractorista"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Tractor:</x-jet-label>
                    <select id="tractor" class="form-select" style="width: 100%" wire:model.defer='tractor'>
                        <option value="0">Seleccione una opción</option>
                        <option value="-1">Autopropulsado</option>
                        @foreach ($tractores as $tractor)
                            <option value="{{ $tractor->id }}">{{ $tractor->ModeloDeTractor->modelo_de_tractor }}
                                {{ $tractor->numero }}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="tractor"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Implemento:</x-jet-label>
                    <select class="select2 implementos" name="implementos[]" id="implementos_id" multiple="multiple" style="width: 100%" wire:model.defer='implemento_id'>
                    @foreach ($implementos as $implemento)
                        <option value="{{ $implemento->id }}">{{ $implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implemento->numero }}</option>
                    @endforeach
                    </select>

                    <x-jet-input-error for="implemento_id"/>

                </div>

                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
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
    <script>
        var implementos = [];
        document.addEventListener('livewire:load', function() {
            $('.select2').select2();
            $('.implementos').on('select2:selecting select2:unselecting', function(e) {
                if(implementos == null) {
                    implementos = [];
                }
                var implemento = e.params.args.data.id;
                if(implementos.includes(implemento)){
                    implementos = implementos.filter((item) => item != implemento);
                }else{
                    implementos.push(implemento);
                }
                @this.set('implemento_id', implementos);
            });
        });
    </script>
</div>
