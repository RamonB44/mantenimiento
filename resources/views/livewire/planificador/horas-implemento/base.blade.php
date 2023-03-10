<div>
    <div class="grid grid-cols-1 {{ $sede_id > 0 ? 'sm:grid-cols-2' : 'sm:grid-cols-1' }}">
        <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
            <select class="form-control" id="id_implemento" style="width: 100%" wire:model='sede_id'>
                <option value="0" class="font-bold text-center text-md">Seleccione una sede</option>
                @foreach ($sedes as $sede)
                <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                @endforeach
            </select>
        </div>
        @if ($sede_id > 0)
        <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
            <select class="form-control" style="width: 100%" wire:model='operario_id'>
                <option value="0" class="font-bold text-center text-md">Seleccione el operario</option>
                @foreach ($operarios as $operario)
                <option value="{{ $operario->id }}">{{ $operario->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
    </div>
    @livewire('planificador.horas-implemento.implemento', ['sede_id' => $sede_id])

</div>
