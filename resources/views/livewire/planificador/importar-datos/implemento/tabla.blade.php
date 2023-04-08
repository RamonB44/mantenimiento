<div>
    @if ($implementos->count())
        <table class="w-full overflow-x-scroll table-fixed">
            <thead>
                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Modelo</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Número</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Horas de Uso</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Sede</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">CeCo</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Responsable</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-light text-gray-600">
                @foreach ($implementos as $implemento)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$implemento->id}})" class="border-b {{ $implemento->id == $implemento_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $implemento->ModeloDelImplemento->modelo_de_implemento }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $implemento->numero }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $implemento->horas_de_uso }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $implemento->Sede->sede }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $implemento->CentroDeCosto->codigo }} - {{ $implemento->CentroDeCosto->descripcion }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $implemento->ResponsableModel->name }}</span>
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
            {{ $implementos->links() }}
        </div>
</div>
