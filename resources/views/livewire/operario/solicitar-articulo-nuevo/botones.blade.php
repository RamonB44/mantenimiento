<div class="grid items-center grid-cols-3 p-6 bg-white">
    <x-boton-crud accion="$emitTo('operario.solicitar-articulo-nuevo.modal','abrirModal',0)" color="green">Crear</x-boton-crud>
    <x-boton-crud accion="$emitTo('operario.solicitar-articulo-nuevo.modal','abrirModal',{{ $material_nuevo }})" :activo="$boton_activo" color="amber">Editar</x-boton-crud>
    <x-boton-crud accion="eliminar" :activo="$boton_activo" color="red">Eliminar</x-boton-crud>
</div>
