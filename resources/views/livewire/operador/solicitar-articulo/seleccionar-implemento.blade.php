<div class="grid grid-cols-1 {{  $implemento_id != 0 ? 'sm:grid-cols-2':''}} gap-4">
    <div class="p-6" style="padding-left: 1rem; padding-right:1rem">
        <select class="form-control" id="id_implemento" style="width: 100%; height:2.5rem" wire:model='implemento_id'>
            <option value="0" class="font-bold text-center text-md">Seleccione una implemento</option>
        @foreach ($implementos as $implemento)
            <option value="{{ $implemento->id }}" class="font-bold text-center text-md">{{ strtoupper($implemento->ModeloDelImplemento->modelo_de_implemento) }} {{ $implemento->numero }}</option>
        @endforeach
        </select>
    </div>
    @if ($implemento_id != 0)
    <div style="display:flex; align-items:center;justify-content:center" class="px-6 py-4">
        <button wire:click="$emit('confirmarCerrarPedido','{{$implemento_id}}')" class="w-full h-16 text-2xl font-bold text-white bg-orange-500 rounded-full hover:bg-orange-700">
            Cerrar Pedido
        </button>
    </div>
    @endif
</div>