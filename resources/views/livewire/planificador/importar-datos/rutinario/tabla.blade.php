<div>
    @if ($rutinarios->count())
        <table class="w-full overflow-x-scroll table-fixed">
            <thead>
                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Componente</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Tarea</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-light text-gray-600">
                @foreach ($rutinarios as $rutinario)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$rutinario->id}})" class="border-b {{ $rutinario->id == $rutinario_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $rutinario->Articulo->articulo }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $rutinario->tarea }}</span>
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
            {{ $rutinarios->links() }}
        </div>
</div>
