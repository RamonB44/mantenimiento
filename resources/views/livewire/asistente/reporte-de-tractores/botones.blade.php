<div class="grid items-center grid-cols-2 p-6 bg-white sm:grid-cols-4">
    <x-boton-crud accion="$emitTo('asistente.reporte-de-tractores.exportar','abrirModal')" color="gray">Exportar</x-boton-crud>
    <x-boton-crud accion="$emitTo('asistente.reporte-de-tractores.modal','abrirModal',0)" color="green">Registrar</x-boton-crud>
    <x-boton-crud accion="$emitTo('asistente.reporte-de-tractores.modal','abrirModal',{{$reporte_id}})" color="amber" :activo="$boton_activo">Editar</x-boton-crud>
    <x-boton-crud accion="$emitTo('asistente.reporte-de-tractores.filtros','abrirModal')" color="indigo">Filtros</x-boton-crud>
</div>
