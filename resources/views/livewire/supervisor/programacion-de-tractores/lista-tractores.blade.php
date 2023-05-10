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
            <table class="w-full min-w-max">
                <tbody class="text-sm font-light text-gray-600">
                    <tr wire:click="$set('tractor',-1)" class="border-b border-gray-200 unselected">
                        <td class="py-4 text-center">
                            <div>
                                <span class="font-medium">AUTOPROPULSADO</span>
                            </div>
                        </td>
                    </tr>
                    @foreach ($tractores as $tractor)
                        <tr wire:click="$set('tractor',{{ $tractor->id }})" class="border-b border-gray-200 unselected">
                            <td class="py-4 text-center">
                                <div>
                                    <span class="font-medium">{{ $tractor->ModeloDeTractor->modelo_de_tractor }} {{ $tractor->numero }}</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
        <x-slot name="footer" class="hidden">

        </x-slot>
    </x-jet-dialog-modal>
</div>
