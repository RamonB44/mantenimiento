<div>
    @if ($fechas_de_pedido->count())
        <table class="w-full overflow-x-scroll table-fixed">
            <thead>
                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Fecha de Apertura</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Fecha de Cierre</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Fecha de Pedido</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Fecha de llegada</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-light text-gray-600">
                @foreach ($fechas_de_pedido as $fecha_de_pedido)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$fecha_de_pedido->id}})" class="border-b {{ $fecha_de_pedido->id == $fecha_pedido_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $fecha_de_pedido->fecha_de_apertura }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $fecha_de_pedido->fecha_de_cierre }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $fecha_de_pedido->fecha_de_pedido }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $fecha_de_pedido->fecha_de_llegada }}</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="px-6 py-4">
            No existe ningún registro coincidente
        </div>
    @endif
        <div class="px-4 py-4">
            {{ $fechas_de_pedido->links() }}
        </div>
</div>
