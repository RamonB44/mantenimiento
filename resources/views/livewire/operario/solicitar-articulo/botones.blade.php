<div class="grid items-center grid-cols-2 p-6 bg-white sm:grid-cols-4">
    <x-boton-crud accion="$emitTo('operario.solicitar-articulo.modal','abrirModal', 'componente')" color="green">Componentes</x-boton-crud>
    <x-boton-crud accion="$emitTo('operario.solicitar-articulo.modal','abrirModal', 'pieza')" color="red">Piezas</x-boton-crud>
    <x-boton-crud accion="$emitTo('operario.solicitar-articulo.modal','abrirModal', 'fungible')" color="amber">Fungibles</x-boton-crud>
    <x-boton-crud accion="$emitTo('operario.solicitar-articulo.modal','abrirModal', 'herramienta')" color="blue">Herramientas</x-boton-crud>
</div>
