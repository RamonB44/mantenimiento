<div>
    <x-jet-dialog-modal maxWidth="2xl" wire:model="open_validate_resquest">
        <x-slot name="title">
            Pedido de {{$operador}}
        </x-slot>
        <x-slot name="content">
        <!------------ Boton para materiales nuevos----------------------->
            @livewire('planificador.validar-solicitud-de-articulo-nuevo.material-nuevo.base', ['fecha_de_pedido' => $fecha_de_pedido, 'sede_id' => $sede_id])
        <!------------------------------------------- SELECT DE LOS IMPLEMENTOS ------------------------------------------------- -->
            <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2">
                <div class="py-2 bg-gray-200 rounded-md shadow-xl" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Implemento: </x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model="id_implemento">
                        <option value="0">Seleccione una implemento</option>
                        @foreach ($implements as $implement)
                            <option value="{{ $implement->id }}"> {{$implement->implement_model}} {{ $implement->implement_number }} </option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="id_implemento"/>

                </div>

                <div class="py-4 mt-2 bg-red-500 rounded-md">
                    <h1 class="text-lg font-bold text-white">Monto Asignado: S/.{{$monto_asignado}}</h1>
                </div>
            </div>
        <!-------------------------------------------TABLA DE LOS MATERIALES ------------------------------------------------- -->
                <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-1">
        <!------------------------ INICIO DE TABLAS --------------------------------------->
            <!------------------------ TABLA DE MATERIALES POR VALIDAR --------------------------------------->
                    @if(count($order_request_detail_operator))
                        <div class="grid grid-cols-1 gap-4 py-4 bg-yellow-200 rounded-md shadow-md sm:grid-cols-2">
                            <div>
                                <h1 class="text-lg font-bold">Pendiente a Validar</h1>
                            </div>
                            <div>
                                <h1 class="text-lg font-bold {{$monto_usado > $monto_asignado ? 'text-red-500' : 'text-green-500'}}">Precio Estimado: S/.{{number_format($monto_usado,2)}}</h1>
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
                                    @foreach ($order_request_detail_operator as $request)
                                        <tr wire:click="mostrarModalValidarMaterial({{$request->id}})" class="border-b border-gray-200 unselected">
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-medium">{{$request->sku}} </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-bold {{$request->type == "PIEZA" ? 'text-red-500' : ( $request->type == "COMPONENTE" ? 'text-green-500' : ($request->type == "COMPONENTE" ? 'text-green-500' : ($request->type == "FUNGIBLE" ? 'text-amber-500' : 'text-blue-500')))}} ">
                                                        {{ strtoupper($request->item) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-bold text-red-600">{{floatVal($request->quantity)}} {{$request->abbreviation}}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-bold text-amber-600">{{floatVal($request->ordered_quantity - $request->used_quantity)}} {{$request->abbreviation}}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-bold text-green-600">{{floatVal($request->stock)}} {{$request->abbreviation}}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
            <!----------------------- TABLA DE MATERIALES VALIDADOS -------------------------------------------->
                    @if(count($order_request_detail_planner))
                        <div class="grid grid-cols-1 gap-4 py-4 bg-yellow-200 rounded-md shadow-md sm:grid-cols-2">
                            <div>
                                <h1 class="text-lg font-bold">Validado</h1>
                            </div>
                            <div>
                                <h1 class="text-lg font-bold {{$monto_real > $monto_asignado ? 'text-red-500' : 'text-green-500'}} ">Precio Real: S/.{{number_format($monto_real,2)}}</h1>
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
                                    @foreach ($order_request_detail_planner as $request)
                                        <tr wire:click="mostrarModalValidarMaterial({{$request->id}})" class="border-b border-gray-200 unselected">
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-medium">{{$request->sku}} </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-bold {{$request->type == "PIEZA" ? 'text-red-500' : ( $request->type == "COMPONENTE" ? 'text-green-500' : ($request->type == "COMPONENTE" ? 'text-green-500' : ($request->type == "FUNGIBLE" ? 'text-amber-500' : 'text-blue-500')))}} ">{{ strtoupper($request->item) }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-bold text-red-600">{{floatVal($request->quantity)}} {{$request->abbreviation}}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-bold text-amber-600">{{floatVal($request->ordered_quantity - $request->used_quantity)}} {{$request->abbreviation}}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-bold text-green-600">{{floatVal($request->stock)}} {{$request->abbreviation}}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
            <!-- ------------------------ TABLA DE MATERIALES RECHAZADOS ---------------------------------------  -->
                @if(count($order_request_detail_rechazado))
                    <div class="py-4 bg-yellow-200 rounded-md shadow-md">
                        <h1 class="text-lg font-bold">Rechazado</h1>
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
                                @foreach ($order_request_detail_rechazado as $request)
                                    <tr wire:click="$emit('confirmarReinsertarRechazado',[{{$request->id}},'{{$request->item}}'])" class="border-b border-gray-200 unselected">
                                        <td class="px-6 py-3 text-center">
                                            <div>
                                                <span class="font-medium">{{$request->sku}} </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-center">
                                            <div>
                                                <span class="font-bold {{$request->type == "PIEZA" ? 'text-red-500' : ( $request->type == "COMPONENTE" ? 'text-green-500' : ($request->type == "COMPONENTE" ? 'text-green-500' : ($request->type == "FUNGIBLE" ? 'text-amber-500' : 'text-blue-500')))}} ">{{ strtoupper($request->item) }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-center">
                                            <div>
                                                <span class="font-bold text-red-600">{{floatVal($request->quantity)}} {{$request->abbreviation}}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-center">
                                            <div>
                                                <span class="font-bold text-amber-600">{{floatVal($request->ordered_quantity - $request->used_quantity)}} {{$request->abbreviation}}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-center">
                                            <div>
                                                <span class="font-bold text-green-600">{{floatVal($request->stock)}} {{$request->abbreviation}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
        <!------------------------ FIN DE TABLAS --------------------------------------->
                </div>
        </x-slot>
        <x-slot name="footer">
            @if($id_implemento > 0)
                <button wire:loading.attr="disabled" wire:click="$emit('confirmarValidarSolicitudPedido',[{{$id_solicitud_pedido}},'{{$implemento}}',{{$monto_usado}},{{$cantidad_materiales_nuevos}}])" style="width: 200px" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-700">
                    Validar
                </button>
                <button wire:loading.attr="disabled" wire:click="$emit('confirmarRechazarSolicitudPedido','{{$implemento}}')" style="width: 200px" class="px-4 py-2 ml-2 text-white bg-red-500 rounded-md hover:bg-red-700">
                    Rechazar
                </button>
            @endif
            <x-jet-secondary-button wire:click="$set('open_validate_resquest',false)" class="ml-2">
                Cancelar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
