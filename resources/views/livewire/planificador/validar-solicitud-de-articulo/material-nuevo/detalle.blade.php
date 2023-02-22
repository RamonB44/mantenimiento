<div>
<x-jet-dialog-modal wire:model="open" maxWidth="2xl">
    <x-slot name="title">
        Detalle del material {{$articulo}}
    </x-slot>
    <x-slot name="content">
        @if ($open)
        <div class="grid grid-cols-2">
            <!-- Material Solicitado por el operador -->
                <div class="grid">
                    <div class="py-2" style="padding-left: 1rem; padding-right:1rem;">
                        <x-jet-label>Cantidad:</x-jet-label>
                        <x-jet-input type="text" style="height:30px;width: 100%" readonly value="{{$cantidad_solicitada}} {{$um}}" />
                    </div>
                    <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                        <x-jet-label>Especificaciones:</x-jet-label>
                        <textarea readonly class="form-control w-full text-sm" rows=5 wire:model.defer="ficha_tecnica"></textarea>
                    </div>
                    <div class="p-2" style="margin-left:15px;margin-right:15px;max-height:16rem">
                        @if ($imagen != "")
                        <img style="display:inline;height:100%" src="{{ $imagen }}">
                        @endif
                    </div>
                </div>
            <!-- CRUD para agregar el material -->
                <div class="grid grid-cols-1">
                    <div class="py-2 text-center" style="padding-left: 1rem; padding-right:1rem">
                        <x-jet-label>Código:</x-jet-label>
                        <x-jet-input type="number" min="0" style="height:30px;width: 100%;text-align: center" wire:model="codigo" />
    
                        <x-jet-input-error for="codigo"/>
    
                    </div>
                    <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                        <x-jet-label>Nombre:</x-jet-label>
                        <x-jet-input type="text" style="height:30px;width: 100%;text-align: center" wire:model="articulo" />
    
                        <x-jet-input-error for="articulo"/>
    
                    </div>
                    <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                        <x-jet-label>Tipo: </x-jet-label>
                        <select class="form-select" style="width: 100%;text-align: center" wire:model='tipo'>
                            <option value="">Seleccione una opción</option>
                            <option>FUNGIBLE</option>
                            <option>HERRAMIENTA</option>
                        </select>
    
                        <x-jet-input-error for="create_material_type"/>
    
                    </div>
                    <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                        <x-jet-label>Unidad de Medida: </x-jet-label>
                        <select class="form-select" style="width: 100%;text-align: center" wire:model='unidad_de_medida_id'>
                            <option value="">Seleccione una opción</option>
                            @foreach ($unidades_de_medida as $unidad_de_medida)
                                <option value="{{ $unidad_de_medida->id }}">{{ $unidad_de_medida->unidad_de_medida }} </option>
                            @endforeach
                        </select>
    
                        <x-jet-input-error for="unidad_de_medida_id"/>
    
                    </div>
                    <div class="py-2" style="padding-left: 1rem; padding-right:1rem; padding-right:1rem">
                        <x-jet-label>Precio Unitario:</x-jet-label>
                        <x-jet-input type="number" min="0" style="height:30px;width: 100%;text-align: center" wire:model="precio" />
    
                        <x-jet-input-error for="precio"/>
    
                    </div>
                    <div class="py-2" style="padding-left: 1rem; padding-right:1rem; padding-right:1rem">
                        <x-jet-label>Cantidad:</x-jet-label>
                        <x-jet-input type="number" min="0" style="height:30px;width: 100%;text-align: center" wire:model="cantidad" />
    
                        <x-jet-input-error for="cantidad"/>
    
                    </div>
                </div>
            </div>
        @endif
    </x-slot>
    <x-slot name="footer">
        <div class="mr-2">
            <x-jet-button wire:loading.attr="disabled" wire:click="registrar">
                Guardar
            </x-jet-button>
        </div>
        <div wire:loading wire:target="registrar">
            Registrando...
        </div>
        <x-jet-button wire:loading.attr="disabled" wire:click="$emit('rechazarMaterialNuevo','{{$articulo}}')">
            Rechazar
        </x-jet-button>
        <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
            Cancelar
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>
</div>