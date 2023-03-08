<div>
<div class="p-4" style="padding-left: 1rem; padding-right:1rem">
    <div class="grid items-center grid-cols-2 p-2 bg-white">
        <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
            <x-jet-label>Fecha:</x-jet-label>
            <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha"/>
        </div>
        <x-boton-crud accion="$emit('excel')" color="green">EXCEL</x-boton-crud>
    </div>
    @livewire('asistente.programacion-de-tractores.tabla', ['supervisor_id' => $supervisor_id])
</div>
