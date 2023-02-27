<div>
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Rutinarios {{$accion == "crear" ? 'no' : ''}} validados
        </x-slot>
        <x-slot name="content">
            @if ($accion == "crear")
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Día:</x-jet-label>
                    <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha"/>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Turno:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='turno'>
                        <option>MAÑANA</option>
                        <option>NOCHE</option>
                    </select>
                </div>
                <div class="py-2 cols-span-1 sm:col-span-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Programacion:</x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model='rutinario'>
                        <option value="0">Seleccione una opción</option>
                    @foreach ($rutinarios as $rutinario)
                        <option value="{{ $rutinario->id }}">{{ $rutinario->Implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $rutinario->Implemento->numero }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            @endif

            @livewire('supervisor.validar-rutinario.tareas')
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
