<div class="grid gap-4 grid-rows-1 grid-cols-1 sm:grid-cols-2">
    <div class="row-span-1">
        <div class="grid gap-4 grid-cols-1 grid-flow-row p-6 bg-white">
            <select id="sedes" name="sedes" wire:model="idSede" data-te-select-init
                data-te-select-placeholder="Sedes">
                <option value="" hidden selected></option>
                @forelse ($listSedes as $item)
                    <option value="{{ $item->id }}">{{ $item->sede }}</option>
                @empty
                @endforelse
            </select>

            <select id="solicitante" name="solicitante" wire:model="idSolicitante" data-te-select-init
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
            <div class="relative mb-3" id="datepicker-init" data-te-input-wrapper-init>
                <input type="text"
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                    placeholder="Elige la Fecha de Inicio" />
                <label for="floatingInput"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                    Elige la Fecha de Inicio</label>
            </div>
            <div class="relative mb-3" id="datepicker-end" data-te-input-wrapper-init>
                <input type="text"
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                    placeholder="Elige la Fecha de Fin" />
                <label for="floatingInput"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                    Elige la Fecha de Fin</label>
            </div>
        </div>
    </div>
</div>
