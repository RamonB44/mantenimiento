<div class="w-full">
    <div class="grid grid-cols-1 {{ $sede_id > 0 ? 'sm:grid-cols-3' : 'sm:grid-cols-1' }} py-2">
        <div style="padding-left: 1rem; padding-right:1rem">
            <x-jet-label>Sede:</x-jet-label>
            <select class="form-control" id="id_implemento" style="width: 100%" wire:model='sede_id'>
                <option value="0" class="font-bold text-center text-md">Seleccione una sede</option>
                @foreach ($sedes as $sede)
                <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                @endforeach
            </select>
        </div>
        @if ($sede_id > 0)
        <div style="padding-left: 1rem; padding-right:1rem">
            <x-jet-label>Fecha:</x-jet-label>
            <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha"/>
        </div>
        <div style="padding-left: 1rem; padding-right:1rem">
            <x-jet-label>Turno:</x-jet-label>
            <select class="form-select" style="width: 100%" wire:model='turno'>
                <option>MAÑANA</option>
                <option>NOCHE</option>
            </select>
        </div>
        @endif
    </div>
    @if ($sede_id > 0)
    <div class="grid grid-cols-1 {{ $supervisor_id > 0 ? 'sm:grid-cols-2' : 'sm:grid-cols-1' }}" wire:loading.remove>
        <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
            <select class="form-control" style="width: 100%" wire:model='supervisor_id'>
                <option value="0" class="font-bold text-center text-md">Seleccione el supervisor</option>
                @foreach ($supervisores as $supervisor)
                <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                @endforeach
            </select>
        </div>
        @if ($supervisor_id > 0)
        <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
            <select class="form-control" style="width: 100%" wire:model='cultivo_fundo_id'>
                <option value="0,0" class="font-bold text-center text-md">Seleccione el supervisor</option>
                @foreach ($cultivo_fundos as $cultivo_fundo)
                <option value="{{ $cultivo_fundo->cultivo_id }},{{ $cultivo_fundo->fundo_id }}">{{ $cultivo_fundo->cultivo }} - {{ $cultivo_fundo->fundo }}</option>
                @endforeach
            </select>
        </div>
        @endif
    </div>
    <div class="flex-1 p-4 bg-white border rounded shadow h-96" wire:loading.remove>
        <livewire:livewire-pie-chart
            key="{{ $pieChartModel->reactiveKey() }}"
            :pie-chart-model="$pieChartModel"
        />
    </div>
    @endif
    <div style="align-items:center;justify-content:center;margin-bottom:15px" wire:loading.flex>
        <div class="text-center">
            <h1 class="text-4xl font-bold">
                CARGANDO DATOS...
            </h1>
        </div>
    </div>
</div>
