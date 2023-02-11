<div style="max-height:180px;overflow:auto">
    <table class="w-full min-w-max">
        <thead>
            <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                <th class="py-3 text-center">
                    <span>Código {{ $implemento_id }}</span>
                </th>
                <th class="py-3 text-center">
                    <span>Material</span>
                </th>
                <th class="py-3 text-center">
                    <span>Solicitado</span>
                </th>
                <th class="py-3 text-center">
                    <span>En Proceso</span>
                </th>
                <th class="py-3 text-center">
                    <span>Stock</span>
                </th>
            </tr>
        </thead>
        <tbody class="text-sm font-light text-gray-600">
            @foreach ($detalle_solicitud_de_pedidos as $detalle_solicitud_de_pedido)
                <tr wire:click="editar({{$detalle_solicitud_de_pedido->id}})" class="border-b border-gray-200 unselected">
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-medium">{{$detalle_solicitud_de_pedido->Articulo->codigo}} </span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-bold {{$detalle_solicitud_de_pedido->Articulo->tipo == "PIEZA" ? 'text-red-500' : ( $detalle_solicitud_de_pedido->Articulo->tipo == "COMPONENTE" ? 'text-green-500' : ($detalle_solicitud_de_pedido->Articulo->tipo == "COMPONENTE" ? 'text-green-500' : ($detalle_solicitud_de_pedido->Articulo->tipo == "FUNGIBLE" ? 'text-amber-500' : 'text-blue-500')))}} ">{{ strtoupper($detalle_solicitud_de_pedido->Articulo->articulo) }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-bold text-red-600">{{ $detalle_solicitud_de_pedido->cantidad }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-bold text-amber-600">0</span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-bold text-green-600">0</span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>