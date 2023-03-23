<div>
    <x-jet-dialog-modal wire:model='open' maxWidth="sm" posicion="relative">
        <x-slot name="title">
            {{ $cultivo }}{{ isset($fundo) ? ' - '.$fundo : '' }}
        </x-slot>
        <x-slot name="content">
            <table class="block min-w-full text-center border-collapse md:table" wire:loading.remove>

                <tbody class="block">
                    @foreach ($programacion_de_tractores as $programacion_de_tractor)
                        <tr style="cursor: pointer" class="block font-medium bg-white border border-red-500">
                            <td class="block p-2 text-left">
                                <div>
                                    <span class="inline-block font-bold" style="width: 50px;padding-left: 0.4rem">
                                        <img src="/img/tabla/tractor.svg" alt="tractor" width="25">
                                    </span>
                                    <span class="font-medium">
                                        {{ $programacion_de_tractor->Tractor->ModeloDeTractor->modelo_de_tractor }} {{ $programacion_de_tractor->Tractor->numero }}
                                    </span>
                                </div>
                            </td>
                            <td class="block p-2 text-left">
                                <div>
                                    <span class="inline-block font-bold" style="width: 50px;padding-left: 0.4rem">
                                        <img src="/img/tabla/lote.png" alt="lote" width="25">
                                    </span>
                                    <span class="absolute font-medium">
                                        <img class="ml-2" src="/img/frutas/{{ strtolower($programacion_de_tractor->Lote->Cultivo->cultivo) }}.png" align="right" alt="cultivo" width="25">{{ $programacion_de_tractor->Lote->Fundo->fundo }} {{ $programacion_de_tractor->Lote->lote }}
                                    </span>
                                </div>
                            </td>
                            <td class="block p-2 text-left">
                                <div>
                                    <span class="inline-block font-bold" style="width: 50px;padding-left: 0.4rem">
                                        <img src="/img/tabla/labor.svg" alt="labor" width="25">
                                    </span>
                                    <span class="font-medium">{{ $programacion_de_tractor->labor->labor }}</span>
                                </div>
                            </td>
                            <td class="block p-2 text-left">
                                <div>
                                    <span class="inline-block font-bold" style="width: 50px;padding-left: 0.4rem">
                                        <img src="/img/tabla/solicitante.png" alt="labor" width="25">
                                    </span>
                                    <span class="font-medium">{{ $programacion_de_tractor->solicitante == null ? 'NO REGISTRADO' : $programacion_de_tractor->Solicitante->name }}</span>
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
