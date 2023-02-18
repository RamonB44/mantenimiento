<div style="max-height:180px;overflow:auto" wire:loading.remove>
    <div>
    <table class="w-full min-w-max">
        <thead>
            <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                <th class="py-3 text-center">
                    <span>Material</span>
                </th>
                <th class="py-3 text-center">
                    <span>Cantidad</span>
                </th>
            </tr>
        </thead>
        <tbody class="text-sm font-light text-gray-600">
            @foreach ($lista_materiales_nuevos as $lista_materiales_nuevo)
                <tr wire:click="seleccionar({{ $lista_materiales_nuevo->id }})" class="border-b {{ $lista_materiales_nuevo->id == $material_nuevo ? 'bg-blue-200' : '' }} border-gray-200 unselected">
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-bold ">{{ strtoupper($lista_materiales_nuevo->nuevo_articulo) }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div>
                            <span class="font-bold text-red-600">{{ $lista_materiales_nuevo->cantidad }}</span>
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