<div>
<x-jet-dialog-modal wire:model='open'>
    <x-slot name="title">
       Materiales Nuevos Solicitados
    </x-slot>
    <x-slot name="content">
        <div style="max-height:180px;overflow:auto">
            <table class="w-full min-w-max">
                <thead>
                    <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                        <th class="py-3 text-center">
                            <span>Componentes</span>
                        </th>
                        <th class="py-3 text-center">
                            <span>Cantidad Solicitida</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm font-light text-gray-600">
                    @foreach ($lista_de_materiales_nuevos as $request)
                        <tr wire:click="$emitTo('planificador.validar-solicitud-de-articulo.material-nuevo.detalle','abrirModal',{{$request->id}})" class="border-b border-gray-200 unselected">
                            <td class="px-6 py-3 text-center">
                                <div>
                                    <span class="font-medium">{{$request->nuevo_articulo}} </span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div>
                                    <span class="font-medium">{{$request->cantidad}} {{$request->UnidadDeMedida->unidad_de_medida}}</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
            Cerrar
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>
</div>
