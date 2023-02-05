<div>
    @if($data != [])
    <div>
        <x-boton-crud accion="autocompletar" color="green">Autocompletar</x-boton-crud>
    </div>
    <table style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%; font-size: 12px; margin-top: 0.99rem;">
        <thead>
            <tr>
                <th style="border: 3px solid black; padding: 0.2rem; text-align: center">Sistema</th>
                <th style="border: 3px solid black; padding: 0.2rem; text-align: center">Componente</th>
                <th style="border: 3px solid black; padding: 0.2rem; text-align: center">Tarea</th>
                <th style="border: 3px solid black; padding: 0.2rem; text-align: center">¿Verficado?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['sistemas'] as $sistema)
              @foreach ($sistema['componentes'] as $indice_componente => $componente)
              @foreach ($componente['tareas'] as $indice_tarea => $tarea)
                <tr>
                        @if ($indice_tarea == 0 && $indice_componente == 0)
                            <td rowspan="{{ $sistema['cantidad_de_tareas']}}" style="border: 3px solid black; padding: 0.2rem; text-align: center"> {{$sistema['sistema']}} </td>
                        @endif
                        @if ($indice_tarea == 0)
                            <td  rowspan="{{count($componente['tareas'])}}" style="border: 3px solid black; padding: 0.2rem; text-align: center">{{ $componente['componente'] }}</td>
                        @endif
                        <td style="border: 3px solid black; padding: 0.2rem; text-align: center">{{$tarea['tarea']}}</td>
                        <td style="border: 3px solid black; padding: 0.4rem; text-align: center">
                            <input type="checkbox" id="tarea{{$tarea['id']}}" name="check_tarea" wire:click="toggle_tarea({{$tarea['id']}})">
                        </td>
                </tr>
                @endforeach
              @endforeach
            @endforeach
        </tbody>
    </table>
    @endif
</div>
