<div class="bg-white p-6 grid items-center" style="grid-template-columns: repeat(3, minmax(0, 1fr))">
    <div class="p-4">
        <button type="button" wire:click="abrir_modal(0)" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
            Registrar
        </button>
    </div>
    <div class="p-4">
        <button type="button" wire:click="abrir_modal({{$programacion_id}})" class="w-full inline-flex items-center justify-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-500 focus:outline-none focus:border-amber-700 focus:ring focus:ring-amber-200 active:bg-amber-600 disabled:opacity-25 transition">
            Editar
        </button>
    </div>
    <div class="p-4">
        <button type="button" wire:click='anular()' class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
            Anular
        </button>
    </div>
</div>
