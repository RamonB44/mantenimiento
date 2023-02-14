<div>
    <x-jet-dialog-modal maxWidth="2xl" wire:model="open">
        <x-slot name="title">
            Pedido de {{ $operario }}
        </x-slot>
        <x-slot name="content">
            @if($operario_id > 0)
        <!------------ Boton para materiales nuevos----------------------->
        <!------------------------------------------- SELECT DE LOS IMPLEMENTOS ------------------------------------------------- -->
            <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2">
                <div class="py-2 bg-gray-200 rounded-md shadow-xl" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Implemento: </x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model="implemento_id">
                        <option value="0">Seleccione una implemento</option>
                        @foreach ($implementos as $implemento)
                            <option value="{{ $implemento->id }}"> {{$implemento->ModeloDelImplemento->modelo_de_implemento}} {{ $implemento->numero  }} </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="implemento_id"/>
                </div>

                <div class="py-4 mt-2 bg-red-500 rounded-md">
                    <h1 class="text-lg font-bold text-center text-white">Monto Disponible: S/.0</h1>
                </div>
            </div>
                @if($implemento_id > 0)
                <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 mt-4">
                    @if(count($order_request_detail_operator))
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4  rounded-md bg-yellow-200 shadow-md py-4">
                            <div>
                                <h1 class="text-lg font-bold">Pendiente a Validar</h1>
                            </div>
                            <div>
                                <h1 class="text-lg font-bold">Precio Estimado: S/.1500</h1>
                            </div>
                        </div>
                        <div style="max-height:180px;overflow:auto">
                            <table class="min-w-max w-full">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 text-center">
                                            <span>Código</span>
                                        </th>
                                        <th class="py-3 text-center">
                                            <span>Componentes</span>
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
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($solicitud_de_articulos as $solicitud_de_articulo)
                                        <tr wire:click="mostrarModalValidarMaterial({{$solicitud_de_articulo->id}})" class="border-b border-gray-200 unselected">
                                            <td class="py-3 px-6 text-center">
                                                <div>
                                                    <span class="font-medium">{{$solicitud_de_articulo->codigo}} </span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <div>
                                                    <span class="font-bold {{$solicitud_de_articulo->type == "PIEZA" ? 'text-red-500' : ( $solicitud_de_articulo->type == "COMPONENTE" ? 'text-green-500' : ($solicitud_de_articulo->type == "COMPONENTE" ? 'text-green-500' : ($solicitud_de_articulo->type == "FUNGIBLE" ? 'text-amber-500' : 'text-blue-500')))}} ">
                                                        {{ strtoupper($solicitud_de_articulo->item) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <div>
                                                    <span class="font-bold text-red-600">{{floatVal($solicitud_de_articulo->quantity)}} {{$solicitud_de_articulo->abbreviation}}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <div>
                                                    <span class="font-bold text-amber-600">{{floatVal($solicitud_de_articulo->ordered_quantity - $solicitud_de_articulo->used_quantity)}} {{$solicitud_de_articulo->abbreviation}}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <div>
                                                    <span class="font-bold text-green-600">{{floatVal($solicitud_de_articulo->stock)}} {{$solicitud_de_articulo->abbreviation}}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                @endif
            @endif
        </x-slot>
        <x-slot name="footer">
            @if($implemento_id > 0)
                <button wire:loading.attr="disabled" wire:click="validarSolicitudPedido()" style="width: 200px" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-700">
                    Validar
                </button>
                <button wire:loading.attr="disabled" wire:click="rechazarSolicitudPedido()" style="width: 200px" class="px-4 py-2 ml-2 text-white bg-red-500 rounded-md hover:bg-red-700">
                    Rechazar
                </button>
            @endif
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cancelar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
