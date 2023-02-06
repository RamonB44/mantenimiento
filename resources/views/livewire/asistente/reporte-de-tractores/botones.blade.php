<div class="bg-white p-6 grid items-center grid-cols-2 sm:grid-cols-4">
    <x-boton-crud accion="abrir_modal(0)" color="green">Registrar</x-boton-crud>
    <x-boton-crud accion="abrir_modal({{$reporte_id}})" color="amber" :activo="$boton_activo">Editar</x-boton-crud>
    <x-boton-crud accion="anular" color="red" :activo="$boton_activo">Anular</x-boton-crud>
    <x-boton-crud accion="filtros()" color="indigo">Filtros</x-boton-crud>
</div>
