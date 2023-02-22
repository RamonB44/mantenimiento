<div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-1" wire:loading.remove>
    @if($lista_de_materiales->count())
        <div class="grid grid-cols-1 gap-4 py-4 text-center bg-yellow-200 rounded-md shadow-md sm:grid-cols-2">
            <div>
                <h1 class="text-lg font-bold">Resumen de pedidos</h1>
            </div>
            <div>
                <h1 class="text-lg font-bold">Precio Estimado: S/. {{ floatval($monto_total) }}</h1>
            </div>
        </div>
        <div style="max-height:180px;overflow:auto">
            <table class="w-full min-w-max">
                <thead>
                    <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                        <th class="py-3 text-center">
                            <span>Código</span>
                        </th>
                        <th class="py-3 text-center">
                            <span>Componentes</span>
                        </th>
                        <th class="py-3 text-center">
                            <span>Cantidad</span>
                        </th>
                        <th class="py-3 text-center">
                            <span>Precio</span>
                        </th>
                        <th class="py-3 text-center">
                            <span>Total</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm font-light text-gray-600">
                    @foreach ($lista_de_materiales as $lista_de_material)
                        <tr class="border-b border-gray-200 unselected">
                            <td class="px-6 py-3 text-center">
                                <div>
                                    <span class="font-medium">{{$lista_de_material->codigo}} </span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div>
                                    <span class="font-bold {{$lista_de_material->tipo == "PIEZA" ? 'text-red-500' : ( $lista_de_material->tipo == "COMPONENTE" ? 'text-green-500' : ($lista_de_material->tipo == "COMPONENTE" ? 'text-green-500' : ($lista_de_material->tipo == "FUNGIBLE" ? 'text-amber-500' : 'text-blue-500')))}} ">
                                        {{ strtoupper($lista_de_material->articulo) }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div>
                                    <span class="font-bold text-red-600">{{ $lista_de_material->cantidad }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div>
                                    <span class="font-bold text-red-600">S/. {{ $lista_de_material->precio }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div>
                                    <span class="font-bold text-red-600">{{ floatval($lista_de_material->total) }}</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
