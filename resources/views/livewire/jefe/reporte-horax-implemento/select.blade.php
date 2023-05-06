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

                <select id="supervisor" name="supervisor" wire:model="idSupervisor" data-te-select-init data-te-select-placeholder="Supervisor"
                    >
                    <option value="" hidden selected></option>
                    @forelse ($listSupervisors as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @empty
                    @endforelse
                </select>


                <select id="implemento" name="implemento" wire:model="idImplemento" data-te-select-init data-te-select-placeholder="Implemento"
                    data-te-select-filter="true">
                    <option value="" hidden selected></option>
                    @forelse ($listImplemento as $item)
                        <option value="{{ $item->id }}">{{ $item->modelo_de_implemento }}</option>
                    @empty
                    @endforelse
                </select>


        </div>
    </div>
    <div class="row-span-1">
        <div class="grid gap-4 grid-cols-1 grid-flow-row p-6 bg-white">
            <div>
                <select id="month" name="month" wire:model="idMonth" data-te-select-init>
                    @forelse ($listMeses as $k => $item)
                        <option value="{{ $k }}">{{ $item }}</option>
                    @empty
                    @endforelse
                </select>
                <label data-te-select-label-ref>Mes</label>
            </div>
            <div>
                <select id="week" name="week" wire:model="idWeek" data-te-select-init>
                    @forelse ($listWeeks as $k => $item)
                        <option value="{{ $k }}">{{ $item }}</option>
                    @empty
                    @endforelse
                </select>
                <label data-te-select-label-ref>Semana</label>
            </div>
        </div>
    </div>
</div>
