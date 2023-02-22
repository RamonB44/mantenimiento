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
            font-size: 12px;
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
                @if ($lista_de_materiales->count())
                <div class="sub">
                    <div class="title">
                        <h2>
                            Pedidos del {{ $fecha }} - Total : S/. {{ floatval($monto_total) }}
                        </h2>
                        @if ($ceco_id > 0)
                        <div>
                            <label style="font-size: 20px; font-weight: 400">Ceco: {{ $codigo_ceco }} - {{ $descripcion_ceco }} </label>
                        </div>
                        @endif
                    </div>
                    <table>
                        <thead>
                            <th>Código</th>
                            <th>Materiales</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            @foreach ($lista_de_materiales as $lista_de_material)
                                <tr>
                                    <td> {{ $lista_de_material->codigo}} </td>
                                    <td> {{ $lista_de_material->articulo }}</td>
                                    <td> {{ floatval($lista_de_material->cantidad) }} {{ $lista_de_material->unidad_de_medida }} </td>
                                    <td> S/.{{ floatval($lista_de_material->precio) }}</td>
                                    <td> S/.{{ floatval($lista_de_material->total) }}</td>
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
