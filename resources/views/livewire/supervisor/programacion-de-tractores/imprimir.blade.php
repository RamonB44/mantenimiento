<div>
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Registrar Programación de tractores
            @if ($data != [])
                @foreach ($data['implementos'] as $implemento)
                    IMPLEMENTO: {{$implemento['modelo']}} {{$implemento['numero']}}
                    @foreach ($implemento['sistemas'] as $sistema)
                        SISTEMA :{{$sistema['sistema']}}
                        @foreach ($sistema['componentes'] as $componente)
                           COMPONENTE: {{$componente['componente']}}
                            @foreach ($componente['tareas'] as $tarea)
                                TAREA : {{$tarea}}
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            @endif
        </x-slot>
        <x-slot name="content">
            <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                <x-jet-label>Día:</x-jet-label>
                <x-jet-input type="date" min="2022-05-18" style="height:40px;width: 100%" wire:model="fecha"/>

                <x-jet-input-error for="fecha"/>

            </div>
            <div>
                @if($data != [])
                @foreach ($data['implementos'] as $implemento)
                    <div class="sub{{ $loop->index > 0 ? ' page-break' : '' }}">
                        <div class="title">
                            <label>Rutinario del Implemento: {{  $implemento['modelo']  }} {{  $implemento['numero']  }} </label>
                            <div class="detalle">
                                <label>Operador: {{  $implemento['operario']  }} </label><br>
                                <label>Fecha: {{  date_format($implemento['fecha'],'d/m/Y')  }} </label>
                                <label>Turno: {{  $implemento['turno']  }} </label>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Sistema</th>
                                    <th>Componente</th>
                                    <th>Tarea</th>
                                    <th>¿Verficado?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($implemento['sistemas'] as $sistema)
                                  @foreach ($sistema['componentes'] as $indice_componente => $componente)
                                  @foreach ($componente['tareas'] as $indice_tarea => $tarea)
                                    <tr>
                                            @if ($indice_tarea == 0)
                                                <td rowspan="{{count($sistema['componentes'])*count($componente['tareas'])}}"> {{$sistema['sistema']}} </td>
                                            @endif
                                            @if ($indice_tarea == 0)
                                                <td  rowspan="{{count($componente['tareas'])}}">{{ $componente['componente'] }}</td>
                                            @endif
                                            <td>{{$tarea}}</td>
                                            <td>
                                                <div class="checkbox">
                                                    <label for="checkbox"></label>
                                                </div>
                                            </td>
                                    </tr>
                                    @endforeach
                                  @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <div id="observations">
                            <p>Observaciones:</p>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:loading.attr="disabled" wire:click="imprimirProgramacion()">
                Imprimir Programación
            </x-jet-button>
            <x-jet-button wire:loading.attr="disabled" wire:click="imprimirRutinario()">
                Imprimir Rutinario
            </x-jet-button>
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cancelar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
