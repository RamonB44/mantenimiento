<div class="pt-6">
    <div class="mb-4 text-center">
        <h1 class="text-2xl font-bold">Materiales Nuevos</h1>
    </div>
    @livewire('operador.solicitar-articulo-nuevo.botones',['implemento_id' => $implemento_id,'fecha_de_pedido' => $fecha_de_pedido])
    @livewire('operador.solicitar-articulo-nuevo.tabla',['implemento_id' => $implemento_id,'fecha_de_pedido' => $fecha_de_pedido])
    @livewire('operador.solicitar-articulo-nuevo.modal',['implemento_id' => $implemento_id,'fecha_de_pedido' => $fecha_de_pedido])
</div>
