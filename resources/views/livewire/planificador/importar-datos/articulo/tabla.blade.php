<div>
    @if ($articulos->count())
        <table class="w-full overflow-x-scroll table-fixed">
            <thead>
                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Codigo</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Descripcion</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Unidad de Medida</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Precio</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-light text-gray-600">
                @foreach ($articulos as $articulo)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$articulo->id}})" class="border-b {{ $articulo->id == $articulo_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $articulo->codigo }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $articulo->articulo }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $articulo->UnidadDeMedida->unidad_de_medida }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $articulo->precio_estimado }}</span>
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
            {{ $articulos->links() }}
        </div>
</div>
