<div>
    <x-boton-crud colspan="2" colspansm="4" accion="$set('open',true)" color="indigo">Filtros</x-boton-crud>
    <x-jet-dialog-modal wire:model='open' class="bg-grey-500">
        <x-slot name="title">
            Filtrar Programación de tractores
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Fecha Inicial:</x-jet-label>
                    <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha_inicial"/>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Fecha Final:</x-jet-label>
                    <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha_final"/>
                </div>
                <div class="col-span-1 py-2 sm:col-span-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Turno:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='turno'>
                        <option value="">TODOS</option>
                        <option>MAÑANA</option>
                        <option>NOCHE</option>
                    </select>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Fundo:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='fundoid'>
                        <option value="0">TODO</option>
                        @foreach ($fundos as $fundo)
                            <option value="{{ $fundo->id }}">{{ $fundo->fundo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Lote:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='loteid'>
                        <option value="0">TODO</option>
                        @foreach ($lotes as $lote)
                            <option value="{{ $lote->id }}">{{ $lote->lote }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Tractorista:</x-jet-label>
                    <select id="tractorista" class="form-select" style="width: 100%" wire:model='tractoristaid'>
                        <option value="0">TODO</option>
                        @foreach ($tractoristas as $tractorista)
                            <option value="{{ $tractorista->id }}">{{ $tractorista->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Tractor:</x-jet-label>
                    <select id="tractor" class="form-select" style="width: 100%" wire:model='tractorid'>
                        <option value="0">TODO</option>
                        @foreach ($tractores as $tractor)
                            <option value="{{ $tractor->id }}">{{ $tractor->ModeloDeTractor->modelo_de_tractor }}
                                {{ $tractor->numero }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Implemento:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='implementoid'>
                        <option value="0">TODO</option>
                    @foreach ($implementos as $implemento)
                        <option value="{{ $implemento->id }}">{{ $implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implemento->numero }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Labor:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='laborid'>
                        <option value="0">TODO</option>
                        @foreach ($labores as $labor)
                            <option value="{{ $labor->id }}">{{ $labor->labor }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:loading.attr="disabled" wire:click="filtrar">
                Filtrar
            </x-jet-button>
            <div wire:loading wire:target="filtrar">
                Filtrando...
            </div>
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
