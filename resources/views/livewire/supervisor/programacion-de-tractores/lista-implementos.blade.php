<div>
    <x-jet-dialog-modal wire:model='open' maxWidth="sm">
        <x-slot name="title">
            <select class="form-control" id="id_implemento" style="width: 100%" wire:model='supervisor'>
                @foreach ($supervisores as $supervisor)
                <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                @endforeach
            </select>
        </x-slot>
        <x-slot name="content">
            <div class="py-2" wire:loading.remove>
                <select class="form-control" id="id_implemento" style="width: 100%" wire:model='modelo_de_implemento_id'>
                    <option value="0">Seleccione un modelo</option>
                    @foreach ($modelos_de_implemento as $modelo_de_implemento)
                    <option value="{{ $modelo_de_implemento->id }}">{{ $modelo_de_implemento->modelo_de_implemento }}</option>
                    @endforeach
                </select>
            </div>
            @if (!empty($implementos_asignados))
            <table class="w-full min-w-max" wire:loading.remove>
                <thead>
                    <tr>
                        <th class="text-white bg-green-600">ASIGNADO</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-light text-gray-600 bg-blue-200">
                    @foreach ($implementos_asignados as $implemento)
                    <tr wire:click="toggleImplemento({{ $implemento->id }})" class="border-b border-gray-200 unselected">
                        <td class="py-4 text-center">
                            <div>
                                <span class="font-medium">{{ $implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implemento->numero }}</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            @if ($modelo_de_implemento_id > 0 && $implementos != [] && $implementos->count())
            <table class="w-full min-w-max" wire:loading.remove>
                <thead>
                    <tr class="text-white bg-amber-600">
                        <th>NO ASIGNADO</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-light text-gray-600">
                    @foreach ($implementos as $implemento)
                    <tr wire:click="toggleImplemento({{ $implemento->id }})" class="border-b border-gray-200 unselected">
                        <td class="py-4 text-center">
                            <div>
                                <span class="font-medium">{{ $implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implemento->numero }}</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <div style="align-items:center;justify-content:center;margin-bottom:10px" wire:loading.flex>
                <div class="text-center">
                    <h1 class="text-4xl font-bold">
                        CARGANDO DATOS...
                    </h1>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            @if ( !empty($implementos_asignados) && (in_array($modelo_de_implemento_id,$modelos_varios)))
            <x-jet-button wire:loading.attr="disabled" wire:click="asignarImplemento">
                Asignar
            </x-jet-button>
            <div wire:loading wire:target="registrar">
                Registrando...
            </div>
            @endif
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
