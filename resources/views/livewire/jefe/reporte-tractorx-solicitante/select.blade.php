<div class="grid gap-4 grid-rows-1 grid-cols-1 sm:grid-cols-2">
    <div class="row-span-1">
        <div class="grid gap-4 grid-cols-1 grid-flow-row p-6 bg-white">
            <select id="sedes" name="sedes" wire:model="idSede" data-te-select-init data-te-select-placeholder="Sedes">
                <option value="" hidden selected></option>
                @forelse ($listSedes as $item)
                    <option value="{{ $item->id }}">{{ $item->sede }}</option>
                @empty
                @endforelse
            </select>

            <select id="solicitante" name="solicitante" wire:model="idSolicitante" data-te-select-init data-te-select-placeholder="Solicitante"
                >
                <option value="" hidden selected></option>
                @forelse ($listSolicitante as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @empty
                @endforelse
            </select>

        </div>
    </div>
</div>
