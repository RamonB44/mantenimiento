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
                    @foreach ($tractoristas as $tractorista)
                        <tr wire:click="$set('tractorista',{{ $tractorista->id }})" class="border-b border-gray-200 unselected">
                            <td class="py-4 text-center">
                                <div>
                                    <span class="font-medium">{{ $tractorista->name }} </span>
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
