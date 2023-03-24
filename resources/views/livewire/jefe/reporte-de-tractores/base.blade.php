<div class="w-full">
    <div class="p-2" style="padding-left: 1rem; padding-right:1rem">
        <select class="form-control" id="id_implemento" style="width: 100%" wire:model='sede_id'>
            <option value="0" class="font-bold text-center text-md">Seleccione una sede</option>
            @foreach ($sedes as $sede)
            <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
            @endforeach
        </select>
    </div>
    @if ($sede_id > 0)
        @livewire('jefe.reporte-de-tractores.tabla', ['sede_id' => $sede_id])
        @livewire('jefe.reporte-de-tractores.reportes-faltantes')
    @endif
</div>
