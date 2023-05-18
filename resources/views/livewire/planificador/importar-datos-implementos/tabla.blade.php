<div>
    <table class="w-full overflow-x-scroll table-fixed">
        <thead>
            <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                <th class="py-3 text-center">
                    <span class="hidden sm:block">Implemento</span>
                </th>
                <th class="py-3 text-center">
                    <span class="hidden sm:block">Articulo Utilizado</span>
                </th>
                <th class="py-3 text-center">
                    <span class="hidden sm:block">Horas Acumuladas</span>
                </th>
            </tr>
        </thead>
        <tbody class="text-sm font-light text-gray-600">
            @forelse ($componentePorImplemento as $componente)
                <tr style="cursor:pointer" wire:click="seleccionar({{ $componente->id }})"
                    class="border-b {{ $componente->id == $implemento_componente_id ? 'bg-blue-200' : '' }} border-gray-200">
                    <td class="py-3 text-center">
                        <div>
                            <span class="font-medium">{{ $componente->Implemento->ModeloDelImplemento->modelo_de_implemento  }} {{ $componente->Implemento->numero }}</span>
                        </div>
                    </td>
                    <td class="py-3 text-center">
                        <div>
                            <span class="font-medium">{{ $componente->Articulo->articulo }}</span>
                        </div>
                    </td>
                    <td class="py-3 text-center">
                        <div>
                            <span class="font-medium">{{ $componente->horas }}</span>
                        </div>
                    </td>
                </tr>
            @empty
            <tr>
                <td class="py-3 text-center" colspan="3">
                    <div>
                        <span class="font-medium">Esperando registros</span>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if ($componentePorImplemento->count())
        <div class="px-4 py-4">
            {{ $componentePorImplemento->links() }}
        </div>
    @endif
</div>
