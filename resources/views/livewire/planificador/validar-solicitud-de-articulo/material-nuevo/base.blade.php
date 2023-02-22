<div>
    @if($cantidad_materiales_nuevos > 0)
        <div class="mt-6">
            <button wire:loading.attr="disabled" style="width: 100%" wire:click="$emitTo('planificador.validar-solicitud-de-articulo.material-nuevo.modal','abrirModal')" class="px-4 py-2 bg-cyan-500 hover:bg-cyan-700 text-white rounded-md">
            @if($cantidad_materiales_nuevos > 1)
                ¡Se solicitaron {{$cantidad_materiales_nuevos}} nuevos materiales!
            @elseif ($cantidad_materiales_nuevos == 1)
                ¡Se solicitó un nuevo material!
            @endif
            </button>
        </div>
    @endif
</div>