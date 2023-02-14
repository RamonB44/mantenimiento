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
                <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-1">
                    @if($materiales_pendientes->count())
                        <div class="grid grid-cols-1 gap-4 py-4 bg-yellow-200 rounded-md shadow-md sm:grid-cols-2">
                            <div>
                                <h1 class="text-lg font-bold">Pendiente a Validar</h1>
                            </div>
                            <div>
                                <h1 class="text-lg font-bold">Precio Estimado: S/.1500</h1>
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
                                            <span>En Almacén</span>
                                        </th>
                                        <th class="py-3 text-center">
                                            <span>Stock</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm font-light text-gray-600">
                                    @foreach ($materiales_pendientes as $materiales_pendiente)
                                        <tr wire:click="mostrarModalValidarMaterial({{$materiales_pendiente->id}})" class="border-b border-gray-200 unselected">
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-medium">{{$materiales_pendiente->Articulo->codigo}} </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-bold {{$materiales_pendiente->Articulo->tipo == "PIEZA" ? 'text-red-500' : ( $materiales_pendiente->Articulo->tipo == "COMPONENTE" ? 'text-green-500' : ($materiales_pendiente->Articulo->tipo == "COMPONENTE" ? 'text-green-500' : ($materiales_pendiente->Articulo->tipo == "FUNGIBLE" ? 'text-amber-500' : 'text-blue-500')))}} ">
                                                        {{ strtoupper($materiales_pendiente->Articulo->articulo) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 text-center">
                                                <div>
                                                    <span class="font-bold text-red-600">{{ $materiales_pendiente->cantidad_solicitada }}</span>
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
