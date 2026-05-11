<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>
        Razonabilidad
    </title>

    <style>

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 6px;
        }

        th {
            background: #f2f2f2;
        }

        .text-end {
            text-align: right;
        }

    </style>

</head>

<body>

    <!-- =====================================
    | HEADER
    ====================================== -->

    <h2>
        Razonabilidad
    </h2>

    <p>

        <strong>
            Código OBS:
        </strong>

        {{ $razonabilidad->solicitud->codigo }}

    </p>

    <p>

        <strong>
            Proceso:
        </strong>

        {{ $razonabilidad->solicitud->nombre_proceso }}

    </p>

    <p>

        <strong>
            Fecha:
        </strong>

        {{ \Carbon\Carbon::parse(
            $razonabilidad->fecha
        )->format('d/m/Y') }}

    </p>

    <!-- =====================================
    | TABLA
    ====================================== -->

    <table>

        <thead>

            <tr>

                <th width="5%">
                    #
                </th>

                <th width="35%">
                    Descripción
                </th>

                <th width="25%">
                    Proveedor Recomendado
                </th>

                <th width="15%">
                    Precio
                </th>

                <th width="20%">
                    Observación
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach(
                $razonabilidad->detalles
                as $detalle
            )

                <tr>

                    <!-- ITEM -->
                    <td>

                        {{ $detalle->solicitudItem->item }}

                    </td>

                    <!-- DESCRIPCIÓN -->
                    <td>

                        {{ $detalle->solicitudItem->descripcion }}

                    </td>

                    <!-- PROVEEDOR -->
                    <td>

                        {{ $detalle->proveedor->nombre }}

                    </td>

                    <!-- PRECIO -->
                    <td class="text-end">

                        ${{ number_format(
                            $detalle->precio_recomendado,
                            2
                        ) }}

                    </td>

                    <!-- OBS -->
                    <td>

                        {{ $detalle->observacion }}

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <!-- =====================================
    | OBSERVACIONES
    ====================================== -->

    <br>

    <h4>
        Observaciones Generales
    </h4>

    <p>

        {{ $razonabilidad->observaciones }}

    </p>

    <!-- =====================================
    | CONCLUSIÓN
    ====================================== -->

    <h4>
        Conclusión Final
    </h4>

    <p>

        {{ $razonabilidad->conclusion }}

    </p>

</body>

</html>