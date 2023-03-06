<div class="grid items-center grid-cols-2 p-6 bg-white sm:grid-cols-4">
    <x-boton-crud accion="imprimir" color="gray">Imprimir</x-boton-crud>
    <x-boton-crud accion="$emitTo('supervisor.programacion-de-tractores.modal','abrirModal',0)" color="green">Registrar</x-boton-crud>
    <x-boton-crud accion="$emitTo('supervisor.programacion-de-tractores.modal','abrirModal',{{$programacion_id}})" color="amber" :activo="$boton_activo">Editar</x-boton-crud>
    <x-boton-crud accion="anular" color="red" :activo="$boton_activo">Anular</x-boton-crud>
    <x-boton-crud colspan="2" colspansm="4" accion="$emitTo('supervisor.programacion-de-tractores.filtros','abrirModal')" color="indigo">Filtros</x-boton-crud>
    <div class="grid items-center grid-cols-3 bg-white col-span-2 sm:col-span-4">
        <x-boton-crud padding="1" accion="$emit('obtenerFecha','{{ $yesterday }}')" color="{{ $fecha_activa == 'yesterday' ? 'green' : 'gray' }}">AYER</x-boton-crud>
        <x-boton-crud padding="1" accion="$emit('obtenerFecha','{{ $today }}')" color="{{ $fecha_activa == 'today' ? 'green' : 'gray' }}">HOY</x-boton-crud>
        <x-boton-crud padding="1" accion="$emit('obtenerFecha','{{$tomorrow}}')" color="{{ $fecha_activa == 'tomorrow' ? 'green' : 'gray' }}">MAÑANA</x-boton-crud>
    </div>
</div>
