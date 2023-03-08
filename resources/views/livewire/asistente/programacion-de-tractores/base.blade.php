<div>
<div class="p-4" style="padding-left: 1rem; padding-right:1rem">
    <div class="grid items-center grid-cols-2 p-2 bg-white">
        <x-boton-crud accion="$emit('excel')" color="green">EXCEL</x-boton-crud>
        @livewire('asistente.programacion-de-tractores.filtros')
    </div>
    @livewire('asistente.programacion-de-tractores.tabla', ['supervisor_id' => $supervisor_id])
</div>
