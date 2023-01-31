<div class="p-6">
    @if ($programacion_de_tractores->count())
        <table class="min-w-max w-full table-fixed overflow-x-scroll">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 text center">
                        <span class="hidden sm:block">Tractorista</span>
                        <img class="sm:hidden flex mx-auto" src="/img/tabla/tractorista.png" alt="driver" width="25">
                    </th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($programacion_de_tractores as $programacion_de_tractor)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$programacion_de_tractor->id}})" class="border-b {{ $programacion_de_tractor->id == $programacion_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->Responsable->name }}</span>
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
            {{ $programacion_de_tractores->links() }}

</div>
