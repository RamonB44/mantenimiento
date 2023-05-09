<div class="grid gap-4 grid-rows-1 grid-cols-1 sm:grid-cols-2">
    <div class="row-span-1">
        <div class="grid gap-4 grid-cols-1 grid-flow-row p-6 bg-white">
            <select id="sedes" wire:model="idSede" data-te-select-init
                data-te-select-placeholder="Sedes">
                <option value="" hidden selected></option>
                @forelse ($listSedes as $item)
                    <option value="{{ $item->id }}">{{ $item->sede }}</option>
                @empty
                @endforelse
            </select>

            <select id="solicitante" wire:model="idSolicitante" data-te-select-init
                data-te-select-placeholder="Solicitante">
                <option value="" hidden selected></option>
                @forelse ($listSolicitante as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @empty
                @endforelse
            </select>

        </div>
    </div>
    <div class="row-span-1">
        <div class="grid gap-4 grid-cols-1 grid-flow-row p-6 bg-white">
            <div class="relative mb-3">
                <input wire:model="startDate" type="date"
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                     />

            </div>
            <div class="relative mb-3">
                <input wire:model="endDate" type="date"
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                     />

            </div>
        </div>
    </div>
</div>
