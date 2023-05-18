<div class="grid items-center grid-cols-2 p-6 bg-white sm:grid-cols-3">
    <x-boton-crud accion="$emitTo('planificador.importar-datos.labor.importar','abrirModal')" color="gray">Importar</x-boton-crud>
    <x-boton-crud accion="$emitTo('planificador.importar-datos.labor.modal','abrirModal',0)" color="green">Registrar</x-boton-crud>
    <x-boton-crud accion="$emitTo('planificador.importar-datos.labor.modal','abrirModal',{{$labor_id}})" color="amber" :activo="$boton_activo">Editar</x-boton-crud>
    {{-- <x-boton-crud accion="$emitTo('planificador.importar-datos.labor.modal','eliminar',{{$labor_id}})" color="red" :activo="$boton_activo">Eliminar</x-boton-crud> --}}
    <x-boton-crud colspan="2" colspansm="4" accion="$emitTo('planificador.importar-datos.labor.filtros','abrirModal')" color="indigo">Filtros</x-boton-crud>
</div>
