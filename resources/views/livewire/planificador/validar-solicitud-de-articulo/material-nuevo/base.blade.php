<div>
    @if($cantidad_materiales_nuevos > 0)
        <div>
            <button wire:loading.attr="disabled" style="width: 100%" wire:click="$set('open_validate_new_material',true)" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-700">
            @if($cantidad_materiales_nuevos > 1)
                ¡Se solicitaron {{$cantidad_materiales_nuevos}} nuevos materiales! CLICK PARA VER
            @elseif ($cantidad_materiales_nuevos == 1)
                ¡Se solicitó un nuevo material! CLICK PARA VER
            @endif
            </button>
        </div>
        @livewire('planificador.validar-solicitud-de-articulo-nuevo.material-nuevo.modal', ['fecha_de_pedido' => $fecha_de_pedido, 'sede_id' => $sede_id])
    @endif
</div>
