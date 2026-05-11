<?php

namespace App\Http\Controllers;


use App\Models\Solicitud;
use App\Models\Razonabilidad;
use App\Models\RazonabilidadDetalle;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;

class RazonabilidadController extends Controller
{
    //
    public function show(
        Solicitud $solicitud
    ) {
        $solicitud->load([
            'items',
            'ofertas.proveedor',
            'ofertas.detalles',
            'razonabilidad.detalles'
        ]);

        return view(
            'razonabilidades.show',
            compact('solicitud')
        );
    }

    public function store(
        Request $request,
        Solicitud $solicitud
    ) {
        /*
    |--------------------------------------------------------------------------
    | CABECERA
    |--------------------------------------------------------------------------
    */
        $razonabilidad = Razonabilidad::create([
            'solicitud_id' => $solicitud->id,
            'observaciones' =>
            $request->observaciones,
            'conclusion' =>
            $request->conclusion,
            'fecha' => now(),

        ]);
        /*
    |--------------------------------------------------------------------------
    | DETALLES
    |--------------------------------------------------------------------------
    */
        foreach ($request->detalles as $detalle) {
            RazonabilidadDetalle::create([
                'razonabilidad_id' =>
                $razonabilidad->id,
                'solicitud_item_id' =>
                $detalle['solicitud_item_id'],
                'proveedor_id' =>
                $detalle['proveedor_id'],
                'precio_recomendado' =>
                $detalle['precio_recomendado'],
                'observacion' =>
                $detalle['observacion'] ?? null,
            ]);
        }

        return redirect()
            ->route(
                'razonabilidades.show',
                $solicitud
            )
            ->with(
                'success',
                'Razonabilidad guardada correctamente'
            );
    }



    public function word(
        Razonabilidad $razonabilidad
    ) {
        $razonabilidad->load([
            'solicitud.items',
            'solicitud.ofertas.proveedor',
            'solicitud.ofertas.detalles.solicitudItem',
            'detalles.proveedor',
            'detalles.solicitudItem',
        ]);

        $phpWord = new PhpWord();

        /*
    |--------------------------------------------------------------------------
    | SECCIÓN
    |--------------------------------------------------------------------------
    */

        $section = $phpWord->addSection([

            'marginTop' => 1000,
            'marginLeft' => 1000,
            'marginRight' => 1000,
            'marginBottom' => 1000,

        ]);

        /*
    |--------------------------------------------------------------------------
    | TÍTULO
    |--------------------------------------------------------------------------
    */

        $titulo =
            'ANALISIS DE RAZONABILIDAD DE PRECIOS '
            . 'DEL PROCESO DE COMPRA POR EL METODO '
            . 'DE COMPARACION DE PRECIOS "CDP '
            . $razonabilidad->solicitud->codigo
            . '-2026 '
            . strtoupper(
                $razonabilidad->solicitud->nombre_proceso
            )
            . '".';

        $section->addText(

            $titulo,
            [
                'bold' => true,
                'size' => 14,
            ],

            [
                'alignment' => Jc::BOTH,
            ]
        );

        $section->addTextBreak(1);

        /*
    |--------------------------------------------------------------------------
    | INTRODUCCIÓN
    |--------------------------------------------------------------------------
    */

        $introduccion =
            'Revisada el acta de apertura y obteniendo '
            . 'los resultados de la Etapa I y II de la '
            . 'evaluación de ofertas, se procede a '
            . 'realizar el Análisis de la Razonabilidad '
            . 'de Precios y considerando que el '
            . 'presupuesto de la Unidad Solicitante es '
            . 'limitado y no da lugar a incrementos, '
            . 'se efectúa al análisis a través del '
            . 'método de ESTIMADOS INDEPENDIENTES '
            . 'O PRESUPUESTO PLANIFICADO.';

        $section->addText(

            $introduccion,

            [
                'size' => 12,
            ],

            [
                'alignment' => Jc::BOTH,
            ]
        );

        $section->addTextBreak(1);

        /*
    |--------------------------------------------------------------------------
    | TABLA PRECIOS PLANIFICADOS
    |--------------------------------------------------------------------------
    */

        $table = $section->addTable([

            'borderSize' => 6,
            'borderColor' => '000000',
            'width' => 100,
            'unit' => 'pct',

        ]);

        $table->addRow();

        $table->addCell(7000)->addText(
            'Item',
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );

        $table->addCell(3000)->addText(
            'Precios Unitarios Planificados',
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );

        foreach (
            $razonabilidad->solicitud->items
            as $item
        ) {
            $table->addRow();

            $table->addCell(7000)->addText(

                'ITEM '
                    . $item->item
                    . ': '
                    . $item->descripcion

            );

            $table->addCell(3000)->addText(

                '$'
                    . number_format(
                        $item->costo_estimado_unitario,
                        2
                    ),

                [],

                [
                    'alignment' => Jc::CENTER
                ]

            );
        }

        $section->addTextBreak(2);

        /*
    |--------------------------------------------------------------------------
    | TABLA COMPARATIVA
    |--------------------------------------------------------------------------
    */

        $section->addText(

            'CUADRO COMPARATIVO DE OFERTAS',

            [
                'bold' => true,
                'size' => 12,
            ]
        );

        $comparativa = $section->addTable([

            'borderSize' => 6,
            'borderColor' => '000000',

        ]);

        /*
    |--------------------------------------------------------------------------
    | HEADER
    |--------------------------------------------------------------------------
    */

        $comparativa->addRow();

        $comparativa->addCell(800)->addText(
            'No.',
            ['bold' => true]
        );

        $comparativa->addCell(4000)->addText(
            'Proponente',
            ['bold' => true]
        );

        foreach (
            $razonabilidad->solicitud->items
            as $item
        ) {
            $comparativa->addCell(1200)->addText(

                $item->item,
                ['bold' => true],

                [
                    'alignment' => Jc::CENTER
                ]
            );
        }

        /*
    |--------------------------------------------------------------------------
    | FILAS
    |--------------------------------------------------------------------------
    */

        foreach (
            $razonabilidad->solicitud->ofertas
            as $index => $oferta
        ) {
            $comparativa->addRow();

            $comparativa->addCell(800)->addText(
                $index + 1
            );

            $comparativa->addCell(4000)->addText(
                $oferta->proveedor->nombre
            );

            foreach (
                $razonabilidad->solicitud->items
                as $item
            ) {
                $detalle = $oferta->detalles
                    ->where(
                        'solicitud_item_id',
                        $item->id
                    )
                    ->first();

                if (
                    !$detalle
                    ||
                    $detalle->no_oferto
                ) {
                    $comparativa->addCell(1200)
                        ->addText(

                            'NO OFERTO',

                            [],

                            [
                                'alignment' => Jc::CENTER,
                            ]
                        );
                } else {
                    $excede =
                        $detalle->precio_unitario
                        >
                        $item->costo_estimado_unitario;

                    $comparativa->addCell(1200)
                        ->addText(

                            '$'
                                . number_format(
                                    $detalle->precio_unitario,
                                    2
                                ),

                            [
                                'bold' => $excede,
                            ],

                            [
                                'alignment' => Jc::CENTER,
                            ]
                        );
                }
            }
        }

        /*
|--------------------------------------------------------------------------
| RESUMEN POR ITEM
|--------------------------------------------------------------------------
*/

        $section->addText(

            'RESUMEN DE OFERTAS RAZONABLES',

            [
                'bold' => true,
                'size' => 12,
            ]
        );

        $section->addTextBreak(1);

        foreach (
            $razonabilidad->solicitud->items
            as $item
        ) {
            $section->addText(

                'ITEM '
                    . $item->item
                    . ': '
                    . $item->descripcion,

                [
                    'bold' => true,
                ]
            );

            $resumen = [];

            foreach (
                $razonabilidad->solicitud->ofertas
                as $oferta
            ) {
                $detalle = $oferta->detalles
                    ->where(
                        'solicitud_item_id',
                        $item->id
                    )
                    ->first();

                if (
                    $detalle
                    &&
                    !$detalle->no_oferto
                ) {
                    $resumen[] = [

                        'proveedor' =>
                        $oferta->proveedor->nombre,

                        'precio' =>
                        $detalle->precio_unitario,

                    ];
                }
            }

            usort(

                $resumen,

                function ($a, $b) {
                    return $a['precio']
                        <=>
                        $b['precio'];
                }

            );

            $tablaResumen = $section->addTable([

                'borderSize' => 6,

                'borderColor' => '000000',

            ]);

            foreach ($resumen as $fila) {
                $tablaResumen->addRow();

                $tablaResumen->addCell(7000)
                    ->addText(
                        $fila['proveedor']
                    );

                $tablaResumen->addCell(3000)
                    ->addText(
                        '$'
                            . number_format(
                                $fila['precio'],
                                2
                            )
                    );
            }

            $section->addTextBreak(1);
        }

        /*
|--------------------------------------------------------------------------
| FIRMA
|--------------------------------------------------------------------------
*/

        $section->addTextBreak(2);

        $section->addText(

            'Distrito de San Salvador, '
                . now()->format('d')
                . ' de '
                . now()->translatedFormat('F')
                . ' de '
                . now()->format('Y')
                . '.'

        );

        $section->addTextBreak(4);

        $section->addText(

            'Tec. Jorge Edgardo Aguilar Hernández',

            [
                'bold' => true,
                'size' => 12,
            ],

            [
                'alignment' => Jc::CENTER,
            ]
        );

        $section->addText(

            'Evaluador Técnico',

            [
                'size' => 12,
            ],

            [
                'alignment' => Jc::CENTER,
            ]
        );

        /*
    |--------------------------------------------------------------------------
    | DESCARGA
    |--------------------------------------------------------------------------
    */

        $fileName =
            'Razonabilidad_'
            . $razonabilidad->solicitud->codigo
            . '.docx';

        $tempFile = storage_path($fileName);

        $writer = IOFactory::createWriter(
            $phpWord,
            'Word2007'
        );

        $writer->save($tempFile);

        return response()->download(
            $tempFile,
            $fileName
        )->deleteFileAfterSend(true);
    }
}
