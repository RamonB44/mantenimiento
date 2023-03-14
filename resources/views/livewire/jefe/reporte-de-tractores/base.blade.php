<div class="w-full">
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
            <select class="form-control" style="width: 100%" wire:model='asistente_id'>
                <option value="0" class="font-bold text-center text-md">Seleccione el asistente</option>
                @foreach ($asistentes as $asistente)
                <option value="{{ $asistente->id }}">{{ $asistente->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
    </div>
    @if ($sede_id > 0)
        <div class="grid items-center grid-cols-3 p-2 bg-white">
            <x-boton-crud accion="$emit('pdf')" color="red">PDF</x-boton-crud>
            <x-boton-crud accion="$emit('excel')" color="green">EXCEL</x-boton-crud>
            @livewire('jefe.reporte-de-tractores.filtros',['sede_id' => $sede_id])
        </div>
        @livewire('jefe.reporte-de-tractores.tabla', ['sede_id' => $sede_id,'asistente_id' => $asistente_id])
    @endif
</div>
