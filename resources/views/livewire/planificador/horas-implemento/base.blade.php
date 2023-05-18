<div>
    <div class="grid grid-cols-1 {{ $sede_id > 0 ? 'sm:grid-cols-2' : 'sm:grid-cols-1' }}">
        <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
            <select class="form-control" id="id_implemento" style="width: 100%" wire:model='sede_id'>
                <option value="0" class="font-bold text-center text-md">Seleccione una sede</option>
                @foreach ($sedes as $sede)
                    <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                @endforeach
            </select>
        </div>
        @if ($sede_id > 0)
            <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
                <select class="form-control" style="width: 100%" wire:model='operario_id'>
                    <option value="0" class="font-bold text-center text-md">Seleccione el operario</option>
                    @foreach ($operarios as $operario)
                        <option value="{{ $operario->id }}">{{ $operario->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
    </div>
    @livewire('planificador.horas-implemento.implementos', ['sede_id' => $sede_id])
    @if ($operario_id > 0 && $implementos->count() > 0)
        <div style="display:flex; align-items:center;justify-content:center;margin-bottom:15px">
            <h1 class="text-2xl font-bold text-center">Implementos</h1>
        </div>
        <div class="grid grid-cols-1 gap-4 p-6 mt-4 sm:grid-cols-4">
            @foreach ($implementos as $k => $implemento)
                <div
                    class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-col items-center text-center">
                        <h5 class="mb-1 text-lg font-medium text-gray-900 dark:text-white">
                            {{ $implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implemento->numero }}</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Implemento</span>
                        <div class="relative inline-flex w-fit lg:mt-6">
                            @if (App\Models\ComponentePorImplemento::where('implemento_id', $implemento->id)->where('estado', 2)->count() > 0)
                                <div
                                    class="absolute bottom-auto left-auto right-0 top-0 z-10 inline-block -translate-y-1/2 translate-x-2/4 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 whitespace-nowrap rounded-full bg-red-700 px-2.5 py-1 text-center align-baseline text-xs font-bold leading-none text-white">
                                    !
                                </div>
                            @endif
                            <button {{-- onclick="showOffCanvas({{ $k }}, {{ $implemento->id }})" --}} wire:click="$emit('mostrarComponentes',{{ $implemento->id }})"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                data-te-ripple-init data-te-ripple-color="light">
                                Ver Componentes
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <div class="invisible fixed bottom-0 left-0 right-0 z-[1045] flex h-full max-h-full max-w-full translate-y-full flex-col border-none bg-white bg-clip-padding text-neutral-700 shadow-sm outline-none transition duration-300 ease-in-out dark:bg-neutral-800 dark:text-neutral-200 [&[data-te-offcanvas-show]]:transform-none"
        tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel" data-te-offcanvas-init>
        <div class="flex items-center justify-between p-4">
            <h5 class="mb-0 font-semibold leading-normal" id="offcanvasBottomLabel">
                {{ isset($implement) ? $implement->ModeloDelImplemento->modelo_de_implemento . ' ' . $implement->numero : '' }}
            </h5>
            <button type="button"
                class="box-content rounded-none border-none opacity-50 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                data-te-offcanvas-dismiss>
                <span
                    class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&.disabled]:pointer-events-none [&.disabled]:select-none [&.disabled]:opacity-25">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </button>
        </div>
        <div class="small flex-grow overflow-y-auto p-4">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-center text-sm font-light">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-2">#</th>
                                        <th scope="col" class="px-6 py-2">Componente</th>
                                        <th scope="col" class="px-6 py-2">Horas de Uso</th>
                                        <th scope="col" class="px-6 py-2">F. Horas</th>
                                        <th scope="col" class="px-6 py-2">Vida Util</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($componentes as $c => $componente)
                                        <tr class="border-b dark:border-neutral-500">
                                            <td class="whitespace-nowrap px-6 py-2 font-medium">

                                                <button onclick="showCollapse({{ $c }})" type="button"
                                                    data-te-ripple-init data-te-ripple-color="light"
                                                    class="inline-block rounded-full bg-primary p-2 uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="h-4 w-4">
                                                        <path fill-rule="evenodd"
                                                            d="M19.5 21a3 3 0 003-3V9a3 3 0 00-3-3h-5.379a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H4.5a3 3 0 00-3 3v12a3 3 0 003 3h15zm-6.75-10.5a.75.75 0 00-1.5 0v4.19l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V10.5z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-2">
                                                @if($componente->estado == "PARA CAMBIO")
                                                <div class="inline-flex w-full items-center rounded-lg {{ $componente->horas > $componente->Articulo->FrecuenciaMantenimiento->tiempo_de_vida ? 'bg-red-100' : 'bg-yellow-100' }} text-base text-danger-700"
                                                role="alert">
                                                <span class="mr-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="h-4 w-4">
                                                        <path fill-rule="evenodd"
                                                            d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                @endif
                                                    {{ $componente->Articulo->articulo }}
                                                @if($componente->estado == "PARA CAMBIO")
                                                </div>
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-2">
                                                {{ $componente->horas }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-2">
                                                {{ $componente->Articulo->FrecuenciaMantenimiento->frecuencia }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-2">
                                                {{ $componente->Articulo->FrecuenciaMantenimiento->tiempo_de_vida }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <div class="!visible hidden" id="collapseExample" data-te-collapse-item>
                                                    <div
                                                        class="block rounded-lg bg-white p-6 shadow-lg dark:bg-zinc-800">
                                                        <div class="flex flex-col">
                                                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                                <div
                                                                    class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                                                    <div class="overflow-hidden">
                                                                        <table
                                                                            class="min-w-full text-center text-sm font-light">
                                                                            <thead
                                                                                class="border-b font-medium dark:border-neutral-500">
                                                                                <tr>
                                                                                    <th scope="col"
                                                                                        class="px-6 py-2">Pieza</th>
                                                                                    <th scope="col"
                                                                                        class="px-6 py-2">Horas de Uso
                                                                                    </th>
                                                                                    <th scope="col"
                                                                                        class="px-6 py-2">Tiempo de
                                                                                        vida
                                                                                    </th>
                                                                                    <th scope="col"
                                                                                        class="px-6 py-2">Estado
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @forelse (App\Models\PiezaPorComponente::where('componente_por_implemento_id',$componente->id)->get() as $i)
                                                                                    <tr
                                                                                        class="border-b dark:border-neutral-500">
                                                                                        <td
                                                                                            class="whitespace-nowrap px-6 py-2">
                                                                                            @if($i->estado == "PARA CAMBIO" or $componente->estado == "PARA CAMBIO")
                                                                                                <div class="inline-flex w-full items-center rounded-lg {{ $componente->horas >= $componente->Articulo->FrecuenciaMantenimiento->tiempo_de_vida ? 'bg-red-100' : ($i->horas >= $i->Pieza->FrecuenciaMantenimiento->tiempo_de_vida ? 'bg-red-100' : 'bg-yellow-100') }} text-base text-danger-700"
                                                                                                    role="alert">
                                                                                                <span class="mr-2">
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                                                        fill="currentColor" class="h-4 w-4">
                                                                                                        <path fill-rule="evenodd"
                                                                                                            d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                                                                                            clip-rule="evenodd" />
                                                                                                    </svg>
                                                                                                </span>
                                                                                            @endif
                                                                                            {{ $i->Pieza->articulo }}
                                                                                            @if($i->estado == "PARA CAMBIO" or $componente->estado == "PARA CAMBIO")
                                                                                                </div>
                                                                                            @endif
                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap px-6 py-2">
                                                                                            {{ $i->horas }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap px-6 py-2">
                                                                                            {{ $i->Pieza->FrecuenciaMantenimiento->tiempo_de_vida }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap px-6 py-2">
                                                                                            {{ $i->estado }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @empty
                                                                                    <tr>
                                                                                        <td colspan="3">
                                                                                            <h2>No hay informacion</h2>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforelse
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @section('js')
        <script>
            var Collapse = null;
            document.addEventListener('DOMContentLoaded', function() {
                const offCanvas = window.offCanvas('[data-te-offcanvas-init]');


                Livewire.on('showOffCanvas', () => {
                    Collapse = window.initCollapse('[data-te-collapse-item]');
                    // alert('A mostrarComponentes was added with the id of: ' + component_id);
                    offCanvas[0].show();
                })
            });

            // function showOffCanvas(number) {
            //     offCanvas[number].show();
            //     // Livewire.emit('mostrarComponentes',component_id);
            // }

            function showCollapse(number) {
                Collapse[number].toggle();
            }
        </script>
    @endsection
