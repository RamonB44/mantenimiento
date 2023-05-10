<div class="w-full mt-2" wire:loading.remove>
    <div class="grid grid-cols-1 sm:grid-cols-2">
        <x-boton-crud accion="$emitTo('planificador.ingreso-articulos.importar','abrirModal')" padding="2" color="green">Importar</x-boton-crud>
        <x-boton-crud accion="$emitTo('planificador.ingreso-articulos.filtros','abrirModal')" padding="2" color="indigo">Filtros</x-boton-crud>
    </div>
    @livewire('planificador.ingreso-articulos.importar', ['sede_id' => $sede_id])
    @if ($ingreso_materiales->count())
    <table class="block min-w-full text-center border-collapse md:table" wire:loading.remove>
        <thead class="block md:table-header-group">
            <tr class="absolute block text-center border border-grey-500 md:border-none md:table-row -top-full md:top-auto -left-full md:left-auto md:relative">
                <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                    <span class="hidden sm:block">PEDIDO</span>
                </th>
                <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                    <span class="hidden sm:block">ARTICULO</span>
                </th>
                <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                    <span class="hidden sm:block">CANTIDAD</span>
                </th>
                <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                    <span class="hidden sm:block">PRECIO</span>
                </th>
                <th class="block p-2 font-bold text-center text-white bg-gray-600 md:border md:border-grey-500 md:table-cell">
                    <span class="hidden sm:block">CECO</span>
                </th>
            </tr>
        </thead>
        <tbody class="block md:table-row-group">
            @foreach ($ingreso_materiales as $ingreso_material)
                <tr style="cursor: pointer" class="block font-medium bg-white border border-red-500 md:border-none md:table-row">
                    <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                        <div>
                            <span class="inline-block font-bold md:hidden" style="width: 100px;padding-left: 0.4rem">
                                Pedido :
                            </span>
                            @if ($ingreso_material->FechaDePedido != NULL)
                            <span class="font-medium">{{ date_format(date_create($ingreso_material->FechaDePedido->fecha_de_pedido),'d-m-Y') }}</span>
                            @else
                            <span class="font-medium">STOCK INICIAL</span>
                            @endif
                        </div>
                    </td>
                    <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                        <div>
                            <span class="inline-block font-bold md:hidden" style="width: 100px;padding-left: 0.4rem">
                                Artículo:
                            </span>
                            <span class="font-medium">{{ $ingreso_material->Articulo->articulo }}</span>
                        </div>
                    </td>
                    <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                        <div>
                            <span class="inline-block font-bold md:hidden" style="width: 100px;padding-left: 0.4rem">
                                Cantidad :
                            </span>
                            <span class="font-medium">{{ $ingreso_material->cantidad }}</span>
                        </div>
                    </td>
                    <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                        <div>
                            <span class="inline-block font-bold md:hidden" style="width: 100px;padding-left: 0.4rem">
                                Precio :
                            </span>
                            <span class="font-medium">S/. {{ $ingreso_material->precio }}</span>
                        </div>
                    </td>
                    <td class="block p-2 text-left md:border md:border-grey-500 md:table-cell">
                        <div>
                            <span class="inline-block font-bold md:hidden" style="width: 100px;padding-left: 0.4rem">
                                Ceco :
                            </span>
                            <span class="font-medium">{{ $ingreso_material->CentroDeCosto->codigo }}</span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-4 py-4" wire:loading.remove>
        {{ $ingreso_materiales->links() }}
    </div>
    @else
    <div class="px-6 py-4" wire:loading.remove>
        No existe ningún registro coincidente
    </div>
    @endif
    <div style="align-items:center;justify-content:center;margin-bottom:15px" wire:loading.flex>
        <div class="text-center">
            <h1 class="text-4xl font-bold">
                CARGANDO DATOS...
            </h1>
        </div>
    </div>
</div>
