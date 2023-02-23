<div style="max-height:180px;overflow:auto" wire:loading.remove>
    <div>
    <table class="w-full min-w-max">
        <thead>
            <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                <th class="py-3 text-center">
                    <span>Código</span>
                </th>
                <th class="py-3 text-center">
                    <span>Material</span>
                </th>
                <th class="py-3 text-center">
                    <span>Solicitado</span>
                </th>
                <th class="py-3 text-center">
                    <span>En Almacén</span>
                </th>
                <th class="py-3 text-center">
                    <span>Stock</span>
                </th>
            </tr>
        </thead>
        <tbody class="text-sm font-light text-gray-600">
            @foreach ($detalle_solicitud_de_pedidos as $detalle_solicitud_de_pedido)
                <tr wire:click="$emitTo('operario.solicitar-articulo.modal','abrirModal', 'editar',{{ $detalle_solicitud_de_pedido->id }})" class="border-b border-gray-200 unselected">
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-medium">{{$detalle_solicitud_de_pedido->codigo}} </span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-bold {{$detalle_solicitud_de_pedido->tipo == "PIEZA" ? 'text-red-500' : ( $detalle_solicitud_de_pedido->tipo == "COMPONENTE" ? 'text-green-500' : ($detalle_solicitud_de_pedido->tipo == "COMPONENTE" ? 'text-green-500' : ($detalle_solicitud_de_pedido->tipo == "FUNGIBLE" ? 'text-amber-500' : 'text-blue-500')))}} ">{{ strtoupper($detalle_solicitud_de_pedido->articulo) }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-bold text-red-600">{{ $detalle_solicitud_de_pedido->cantidad_solicitada }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-bold text-amber-600">{{ $detalle_solicitud_de_pedido->almacen }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-bold text-green-600">{{ $detalle_solicitud_de_pedido->stock }}</span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div style="align-items:center;justify-content:center;margin-bottom:15px" wire:loading.flex>
    <div class="text-center">
        <h1 class="text-4xl font-bold">
            CARGANDO DATOS...
        </h1>
    </div>
</div>
</div>
