<div>
    @if ($epps->count())
        <table class="w-full overflow-x-scroll table-fixed">
            <thead>
                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Sede</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Código</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Descripcion</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Monto</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-light text-gray-600">
                @foreach ($epps as $epp)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$epp->id}})" class="border-b {{ $epp->id == $epp_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $epp->Sede->sede }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $epp->codigo }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $epp->descripcion }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $epp->monto }}</span>
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
            {{ $epps->links() }}
        </div>
</div>
