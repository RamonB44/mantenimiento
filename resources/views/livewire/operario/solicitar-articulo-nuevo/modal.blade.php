<div>
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Material Nuevo
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="col-span-2 py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Nombre:</x-jet-label>
                    <x-jet-input type="text" style="height:30px;width: 100%" wire:model.defer="articulo" />
                    <x-jet-input-error for="articulo"/>
                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem;">
                    <x-jet-label>Cantidad:</x-jet-label>
                    <x-jet-input type="number" min="0" style="height:30px;width: 100%" wire:model.defer="cantidad" />

                    <x-jet-input-error for="cantidad"/>

                </div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Unidad de Medida: </x-jet-label>
                    <select class="form-select" style="width: 100%" wire:model.defer='unidad_de_medida'>
                        <option value="">Seleccione una opción</option>
                        @foreach ($unidades_medida as $unidad_medida)
                            <option value="{{ $unidad_medida->id }}">{{ $unidad_medida->unidad_de_medida }} </option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="unidad_de_medida"/>

                </div>
                <div class="col-span-2 py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Especificaciones:</x-jet-label>
                    <textarea class="w-full text-sm form-control" rows=5 wire:model.defer="ficha_tecnica"></textarea>
                </div>
                <div class="col-span-2 py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-jet-label>Imagen:</x-jet-label>
                    <input type="file"  id="upload{{$iteracion}}" style="height:30px;width: 100%" wire:model.defer="imagen" accept="image/*"/>

                    <x-jet-input-error for="imagen"/>

                </div>

                <div wire:loading wire:target='imagen' class="flex col-span-2 p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800">
                    <div>
                        <strong class="font-bold">Imagen Cargando!</strong> <span class="block sm:inline">Espere a que termine de cargar.</span>
                    </div>
                </div>

                @if($imagen)
                <div class="col-span-2 p-2" style="margin-left:15px;margin-right:15px;max-height:16rem">
                        <img style="display:inline;height:100%" src="{{ $imagen->temporaryUrl() }}">
                    </div>
                @else
                    <div class="col-span-2 p-2" style="margin-left:15px;margin-right:15px;max-height:16rem">
                        <img style="display:inline;height:100%" src="{{ str_replace('public','/storage',$imagen_antigua) }}">
                    </div>
                @endif
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:loading.attr="disabled" wire:click="registrar()">
                Actualizar
            </x-jet-button>
            <div wire:loading wire:target="registrar">
                Registrando...
            </div>
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cancelar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
