<div>
    @if ($existe_pedido)
        @livewire('operador.solicitar-articulo.cabecera')
        @livewire('operador.solicitar-articulo.seleccionar-implemento')
    @else
    <div style="display:flex; align-items:center;justify-content:center;margin-bottom:15px">
        <div class="text-center">
            <h1 class="text-4xl font-bold">
                NO HAY PEDIDOS ABIERTOS
            </h1>
        </div>
    </div>
    @endif
</div>
