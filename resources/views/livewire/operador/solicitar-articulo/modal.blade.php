<div>
    @if($tipo != "")
    <x-jet-dialog-modal maxWidth="sm" wire:model='open'>
        <x-slot name="title">
            Registrar
        </x-slot>
        <x-slot name="content">
            <div class="grid">
                @if ($tipo == "pieza")
                <div>
                    <x-jet-label>Componente: </x-jet-label>
                    <select class="text-center form-control" style="width: 100%" wire:model='componente'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($componentes as $componente)
                        <option value="{{ $componente->Articulo->id }}">{{$componente->Articulo->codigo}} - {{$componente->Articulo->articulo}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div>
                    <x-jet-label>{{ ucfirst($tipo) }}: </x-jet-label>
                    <select class="text-center form-control" style="width: 100%" wire:model='articulo'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($articulos as $art)
                        <option value="{{ $art->id }}">{{$art->codigo}} - {{$art->articulo}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="align-items:center;justify-content:center;margin-bottom:15px" wire:loading.flex  wire:target="articulo">
                <div class="text-center">
                    <h1 class="font-bold text-md">
                        CARGANDO DATOS...
                    </h1>
                </div>
            </div>
            @if($articulo > 0)
                <div class="grid grid-cols-2" wire:loading.remove>
                    <div class="mb-4">
                        <x-jet-label class="text-md">En Almacén:</x-jet-label>
                        <div class="flex px-4">

                            <input readonly class="text-lg font-bold text-center text-white border-gray-300 shadow-sm bg-amber-600 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-l-md" type="number" min="0" style="height:30px;width: 100%" value="{{$en_proceso}}"/>

                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-r-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                {{ $unidad_de_medida }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-jet-label class="text-md">Stock:</x-jet-label>
                        <div class="flex px-4">

                            <input readonly class="text-lg font-bold text-center text-white bg-green-600 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-l-md" type="text" style="height:30px;width: 100%" value="{{$stock}}"/>

                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-r-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                {{ $unidad_de_medida }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mb-4" wire:loading.remove>
                    <x-jet-label class="text-md">Solicitado:</x-jet-label>
                    <div class="flex px-4">

                        <input class="text-lg font-bold text-center text-white bg-red-600 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-l-md" type="number" min="0" style="height:30px;width: 100%" wire:model.defer="cantidad"/>

                        <x-jet-input-error for="quantity_component_for_add"/>
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-r-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            {{ $unidad_de_medida }}
                        </span>
                    </div>
                </div>
                @endif
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:loading.attr="disabled" wire:click="registrar()">
                Guardar
            </x-jet-button>
            <div wire:loading wire:target="registrar">
                Registrando...
            </div>
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cancelar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
    @endif
</div>
