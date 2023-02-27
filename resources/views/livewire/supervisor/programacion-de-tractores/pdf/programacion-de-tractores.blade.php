<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Programación de Tractores del {{ $fecha }}</title>

    <style>
        html{
            margin-top: 0.2rem;
            margin-left: 2rem;
            margin-right: 2rem;
        }
        table{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 15px;
            margin-top: 0.99rem;
        }
        th,td{
            border: 3px solid black;
            padding: 1rem;
            text-align: center
        }
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .sub{
            padding-bottom: 0.5rem;
            margin-top: 0.5rem;
        }
        .title{
            text-align: center;
            align-items: center;
        }
        .page-break{
            page-break-before: always;
        }
    </style>

</head>
<body>
    <div>
        <div class="container">
            <div>
                @if ($programaciones_am->count())
                <div class="sub">
                    <div class="title">
                        <h2>
                            Programación de Tractores del {{ $fecha }} Turno Mañana
                        </h2>
                    </div>
                    <table>
                        <thead>
                            <th>Operador</th>
                            <th>Tractor</th>
                            <th>Implementos</th>
                            <th>Labor</th>
                            <th>Lote</th>
                        </thead>
                        <tbody>
                            @foreach ($programaciones_am as $programacion)
                                <tr>
                                    <td> {{ $programacion->Tractorista->name }} </td>
                                    <td>
                                        @if ($programacion->Tractor == null)
                                            Autopropulsado
                                        @else
                                        {{ $programacion->Tractor->ModeloDeTractor->modelo_de_tractor }} {{ $programacion->Tractor->numero }}
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($programacion->ImplementoProgramacion as $implementoProgramacion)
                                        {{ $implementoProgramacion->Implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implementoProgramacion->Implemento->numero }},
                                        @endforeach
                                    </td>
                                    <td> {{ $programacion->labor->labor }} </td>
                                    <td> {{ $programacion->Lote->lote }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                @if ($programaciones_pm->count())
                <div class="sub {{ $programaciones_am->count() ? "page-break" : "" }}">
                    <div class="title">
                        <h2>Programación de Tractores del {{ $fecha }} Turno Noche </h2>
                    </div>
                    <table>
                        <thead>
                            <th>Operador</th>
                            <th>Tractor</th>
                            <th>Implemento</th>
                            <th>Labor</th>
                            <th>Lote</th>
                        </thead>
                        <tbody>
                            @foreach ($programaciones_pm as $programacion)
                                <tr>
                                    <td> {{ $programacion->Tractorista->name }} </td>
                                    <td>
                                        @foreach ($programacion->ImplementoProgramacion as $implementoProgramacion)
                                            {{ $implementoProgramacion->Implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implementoProgramacion->Implemento->numero }},
                                        @endforeach
                                    </td>                                    <td> {{ $programacion->Tractor->ModeloDeTractor->modelo_de_tractor }} {{ $programacion->Tractor->numero }} </td>
                                    <td> {{ $programacion->labor->labor }} </td>
                                    <td> {{ $programacion->Lote->lote }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
