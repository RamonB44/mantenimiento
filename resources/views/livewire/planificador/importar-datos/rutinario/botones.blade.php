<div class="grid items-center grid-cols-1 p-6 bg-white">
    <x-boton-crud accion="$emitTo('planificador.importar-datos.rutinario.importar','abrirModal')" color="gray">Importar</x-boton-crud>
    {{-- <x-boton-crud accion="$emitTo('planificador.importar-datos.rutinario.modal','abrirModal',0)" color="green">Registrar</x-boton-crud> --}}
    {{-- <x-boton-crud accion="$emitTo('planificador.importar-datos.rutinario.modal','abrirModal',{{$rutinario_id}})" color="amber" :activo="$boton_activo">Editar</x-boton-crud> --}}
    {{-- <x-boton-crud accion="eliminar" color="red" :activo="$boton_activo">Eliminar</x-boton-crud> --}}
    {{-- <x-boton-crud colspan="2" colspansm="4" accion="filtros" color="indigo">Filtros</x-boton-crud> --}}
</div>
