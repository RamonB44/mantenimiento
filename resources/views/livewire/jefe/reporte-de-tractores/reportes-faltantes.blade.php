<div>
    <x-jet-dialog-modal wire:model='open' maxWidth="sm" posicion="relative" color="{{ $turno == 'MAÑANA' ? 'amber' : 'blue' }}">
        <x-slot name="title">
            Tractores no Reportados
        </x-slot>
        <x-slot name="content">
            <table class="w-full bg-white min-w-max" wire:loading.remove>
                <tbody class="text-sm font-light text-gray-600 bg-white">
                    @foreach ($tractores_no_reportados as $tractor)
                        <tr class="border-2 border-red-500 rounded-lg unselected">
                            <td class="py-4 text-center">
                                <div>
                                    <span class="font-medium">{{ $tractor->Tractor->ModeloDeTractor->modelo_de_tractor }} {{ $tractor->Tractor->numero }}</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
        <x-slot name="footer" class="hidden">
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
