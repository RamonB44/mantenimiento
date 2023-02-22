
<x-jet-dialog-modal maxWidth="sm" wire:model="open">
    <x-slot name="title">
        <h1>{{$articulo}}</h1>
    </x-slot>
    <x-slot name="content">

        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <x-jet-label class="text-md">En Almacén:</x-jet-label>
                <div class="flex">

                    <input disabled class="text-lg font-bold text-center text-white border-gray-300 shadow-sm bg-amber-600 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-l-md" type="number" min="0" style="height:30px;width: 100%" value="{{$almacen}}"/>

                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-r-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        {{$unidad_de_medida}}
                    </span>
                </div>
            </div>

            <div class="mb-4">
                <x-jet-label class="text-md">Stock:</x-jet-label>
                <div class="flex">

                    <input disabled class="text-lg font-bold text-center text-white bg-green-600 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-l-md" type="text" style="height:30px;width: 100%" value="{{$stock}}"/>

                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-r-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        {{$unidad_de_medida}}
                    </span>
                </div>
            </div>
        </div>
        <div class="py-2" style="padding-left: 1rem; padding-right:1rem;">
            <x-jet-label>Cantidad Solicitada - <span class="text-sm text-blue-700">(0 para rechazar)</span></x-jet-label>
               <div class="flex">
                    <input class="text-lg font-bold text-center text-white bg-red-600 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-l-md" type="number" min="0" style="height:30px;width: 100%" wire:model="cantidad" />

                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-r-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        {{$unidad_de_medida}}
                    </span>
                </div>
            <x-jet-input-error for="cantidad"/>
        </div>
        <div class="py-2" style="padding-left: 1rem; padding-right:1rem;">
            <x-jet-label>Precio Unitario</x-jet-label>
            <x-jet-input type="number" min="0" style="height:30px;width: 100%" class="text-center" wire:model="precio"/>
            <x-jet-input-error for="precio"/>
        </div>
        <div class="py-2" style="padding-left: 1rem; padding-right:1rem;">
            <x-jet-label>Precio Total</x-jet-label>
            <x-jet-input type="number" min="0" disabled style="height:30px;width: 100%" class="text-center" value="{{ $precio_total }}"/>

        </div>
    </x-slot>
    <x-slot name="footer">
        @if ($estado == "CERRADO")
            @if ($cantidad == 0)
                <x-jet-button wire:loading.attr="disabled" wire:click="validar">
                    Rechazar
                </x-jet-button>
            @else
                <x-jet-button wire:loading.attr="disabled" wire:click="validar">
                    Validar
                </x-jet-button>
            @endif
            <div wire:loading wire:target="validar">
                Registrando...
            </div>
        @endif
        <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
            Cerrar
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>
