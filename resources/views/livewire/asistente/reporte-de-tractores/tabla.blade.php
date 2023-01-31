<div class="p-6">
    @if ($reporte_de_tractores->count())
        <table class="min-w-max w-full table-fixed overflow-x-scroll">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 text center">
                        <span class="hidden sm:block">Tractorista</span>
                        <img class="sm:hidden flex mx-auto" src="/img/driver.png" alt="driver" width="25">
                    </th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($reporte_de_tractores as $reporte_de_tractor)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$reporte_de_tractor->id}})" class="border-b {{ $reporte_de_tractor->id == $reporte_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $reporte_de_tractor->user->name }}</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
