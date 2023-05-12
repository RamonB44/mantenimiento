<div class="grid gap-4 grid-rows-1 grid-cols-1 sm:grid-cols-2">
    <div class="row-span-1">
        <div class="grid gap-4 grid-cols-1 grid-flow-row p-6 bg-white">
            <select id="sedes" name="sedes" wire:model="idSede" class="form-select" style="width: 100%" >

                <option value="" hidden selected>Selecciona una Sede</option>
                @forelse ($listSedes as $item)
                    <option value="{{ $item['id'] }}">{{ $item['sede'] }}</option>
                @empty
                @endforelse
            </select>

            <select id="supervisor" name="supervisor" wire:model="idSupervisor" class="form-select" style="width: 100%">
                <option value="" hidden selected>Selecciona un Supervisor</option>
                @forelse ($listSupervisors as $k => $item)
                    <option value="{{ $k }}">{{ $item }}</option>
                @empty
                @endforelse
            </select>

            <select id="month" name="month" wire:model="idMonth" class="form-select" style="width: 100%">
                @forelse ($listMeses as $k => $item)
                    <option value="{{ $k }}">{{ $item }}</option>
                @empty
                @endforelse
            </select>

        </div>
    </div>
    <div class="row-span-1">
        <div class="grid gap-4 grid-cols-1 grid-flow-row p-6 bg-white">
            <select id="implemento" name="implemento" wire:model="idImplemento" class="form-select" style="width: 100%">
                <option value="" hidden selected>Selecciona un Modelo de Implemento</option>
                @forelse ($listImplemento as $k => $item)
                    <option value="{{ $k }}">{{ $item }}</option>
                @empty
                @endforelse
            </select>

            <select id="mimplemento" name="mimplemento" wire:model="idMImplemento" class="form-select"
                style="width: 100%">
                <option value="" selected>Selecciona un Implemento</option>
                @forelse ($listMImplemento as $k => $item)
                    <option value="{{ $item->ModeloDelImplemento->modelo_de_implemento }} N°{{ $item->numero }}">{{ $item->ModeloDelImplemento->modelo_de_implemento }} N°{{ $item->numero }}</option>
                @empty
                @endforelse
            </select>

            <select id="week" name="week" wire:model="idWeek" class="form-select" style="width: 100%">
                @forelse ($listWeeks as $k => $item)
                    <option value="{{ $k }}">{{ $item }}</option>
                @empty
                @endforelse
            </select>

        </div>
    </div>
</div>
