<div class="w-full">
    <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
        <select class="form-control" style="width: 100%" wire:model='sede_id'>
            <option value="0" class="font-bold text-center text-md">Seleccione una sede</option>
            @foreach ($sedes as $sede)
            <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
            @endforeach
        </select>
    </div>
    @if ($sede_id > 0)
        @livewire('planificador.ingreso-articulos.tabla', ['sede_id' => $sede_id])
    @endif
</div>
