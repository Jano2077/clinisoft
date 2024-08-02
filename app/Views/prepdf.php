<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibos de Sueldo</title>
    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .rounded-table {
            border-radius: 10px;
            overflow: hidden;
        }
        .rounded-table th:first-child,
        .rounded-table td:first-child {
            border-left: none;
        }
        .rounded-table th:last-child,
        .rounded-table td:last-child {
            border-right: none;
        }
        .rounded-table tr:first-child th {
            border-top: none;
        }
        .rounded-table tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <h1>Recibos de Sueldo</h1>

    <?php foreach ($jsonData['objeto']['recibos'] as $recibo): ?>
        <h2>Persona: <?= esc($recibo['persona']) ?> (DNI: <?= esc($recibo['dni']) ?>)</h2>
        <p><strong>Periodo:</strong> <?= esc($recibo['dato4_Periodo']) ?></p>
        <p><strong>Fecha de Nacimiento:</strong> <?= esc($recibo['dato2_FechaNacimiento']) ?></p>
        <p><strong>Neto:</strong> <?= esc($recibo['dato3_Neto']) ?></p>

        <h3>Haberes</h3>
        <table class="rounded-table">
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Descripción</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recibo['haberes']['linea'] as $haber): ?>
                    <tr>
                        <td><?= esc($haber['valor']) ?></td>
                        <td><?= esc($haber['descripcion']) ?></td>
                        <td><?= esc($haber['importe']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><strong>Subtotal</strong></td>
                    <td><?= esc($recibo['haberes']['subTotal']) ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Total</strong></td>
                    <td><?= esc($recibo['haberes']['total']) ?></td>
                </tr>
            </tbody>
        </table>

        <h3>Descuentos Columna 1</h3>
        <table class="rounded-table">
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Descripción</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recibo['descuentos_Col1']['linea'] as $descuento): ?>
                    <tr>
                        <td><?= esc($descuento['valor']) ?></td>
                        <td><?= esc($descuento['descripcion']) ?></td>
                        <td><?= esc($descuento['importe']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><strong>Subtotal</strong></td>
                    <td><?= esc($recibo['descuentos_Col1']['subTotal']) ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Total</strong></td>
                    <td><?= esc($recibo['descuentos_Col1']['total']) ?></td>
                </tr>
            </tbody>
        </table>

        <h3>Descuentos Columna 2</h3>
        <table class="rounded-table">
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Descripción</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recibo['descuentos_Col2']['linea'] as $descuento): ?>
                    <tr>
                        <td><?= esc($descuento['valor']) ?></td>
                        <td><?= esc($descuento['descripcion']) ?></td>
                        <td><?= esc($descuento['importe']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><strong>Subtotal</strong></td>
                    <td><?= esc($recibo['descuentos_Col2']['subTotal']) ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Total</strong></td>
                    <td><?= esc($recibo['descuentos_Col2']['total']) ?></td>
                </tr>
            </tbody>
        </table>

        <h3>Liquidación de Haberes</h3>
        <p><strong>Nombre del Agente:</strong> <?= esc($recibo['liquidacionHaberes']['nombreAgente']) ?></p>
        <p><strong>DNI:</strong> <?= esc($recibo['liquidacionHaberes']['dni']) ?></p>
        <p><strong>Fecha de Nacimiento:</strong> <?= esc($recibo['liquidacionHaberes']['fechaNacimiento']) ?></p>
        <p><strong>Periodo Liquidado:</strong> <?= esc($recibo['liquidacionHaberes']['periodoLiquidado']) ?></p>
        <p><strong>Neto:</strong> <?= esc($recibo['liquidacionHaberes']['neto']) ?></p>
    <?php endforeach; ?>
</body>
</html>