<div>
    @if ($rutinarios->count())
        <table class="w-full table-fixed overflow-x-scroll">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Implemento</span>
                        <img class="sm:hidden flex mx-auto" src="/img/tabla/implemento.png" alt="implemento" width="25">
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Operario</span>
                        <img class="sm:hidden flex mx-auto" src="/img/tabla/operario.png" alt="fecha" width="25">
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Día</span>
                        <img class="sm:hidden flex mx-auto" src="/img/tabla/fecha.svg" alt="fecha" width="28">
                    </th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($rutinarios as $rutinario)
                    <tr style="cursor:pointer" wire:click="editar({{$rutinario->id}})" class="border-b border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $rutinario->Implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $rutinario->Implemento->numero }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $rutinario->Implemento->Responsable->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $rutinario->fecha }}</span>
                                <div class="flex items-center justify-center">
                                    <img src="/img/tabla/{{ $rutinario->turno == 'MAÑANA' ? 'sol' : 'luna' }}.svg"
                                        alt="turno" width="25">
                                </div>
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
