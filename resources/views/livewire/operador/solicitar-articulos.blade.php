<div>
    <div wire:loading.remove>
    @if ($existe_pedido)
        @livewire('operador.solicitar-articulo.cabecera',['fecha_de_pedido' => $fecha_de_pedido, 'existe_pedido' => $existe_pedido])
        @livewire('operador.solicitar-articulo.seleccionar-implemento',['fecha_de_pedido' => $fecha_de_pedido])
        <div class="px-6 py-4 text-center">
            @if ($implemento_id > 0)
        <!-------GRID DE BOTONES PARA AGREGAR MATERIALES -->
            <div>
                    <div class="text-center">
                        <h1 class="font-bold text-md">Añadir a la solicitud:</h1>
                    </div>
                    @livewire('operador.solicitar-articulo.botones')
            </div>
            <div>
                <!-------TABLA DE MATERIALES PEDIDOS YA EXISTENTES -->
                @livewire('operador.solicitar-articulo.tabla',['implemento_id' => $implemento_id,'fecha_de_pedido' => $fecha_de_pedido])
            </div>
            @else
            <div class="px-6 py-4 text-center">
                <h1 class="pb-4 text-3xl font-bold">NINGÚN IMPLEMENTO SELECCIONADO </h1>
            </div>
            @endif
        </div>
        @livewire('operador.solicitar-articulo.modal',['implemento_id' => $implemento_id,'fecha_de_pedido' => $fecha_de_pedido, 'existe_pedido' => $existe_pedido])
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
    <div style="align-items:center;justify-content:center;margin-bottom:15px" wire:loading.flex>
        <div class="text-center">
            <h1 class="text-4xl font-bold">
                CARGANDO DATOS...
            </h1>
        </div>
    </div>
</div>
