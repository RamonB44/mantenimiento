<div>
    @if ($usuarios->count())
        <table class="w-full overflow-x-scroll table-fixed">
            <thead>
                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Codigo</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Nombre</span>
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Rol</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-light text-gray-600">
                @foreach ($usuarios as $usuario)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$usuario->id}})" class="border-b {{ $usuario->id == $usuario_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $usuario->codigo }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $usuario->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                @if ($usuario->roles()->get()->count() > 0)
                                @foreach ( $usuario->roles()->get() as $item)
                                <span class="p-2 mr-2 font-medium text-white bg-{{ $item->name == 'asistente' ? 'cyan' : ( $item->name == 'operario' ? 'green' : ( $item->name == 'supervisor' ? 'red' : ( $item->name == 'planificador' ? 'amber' : 'indigo' ) ) ) }}-600 rounded-2xl">{{ strtoupper($item->name) }}</span>
                                @endforeach
                                @else
                                <span class="font-medium">SIN ROL</span>
                                @endif
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
            {{ $usuarios->links() }}
        </div>
</div>
