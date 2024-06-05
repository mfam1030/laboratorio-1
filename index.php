<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deudor = $_POST['deudor'] ?? '';
    $cuota = $_POST['cuota'] ?? 0;
    $cuota_capital = $_POST['cuota_capital'] ?? 0.0;
    $fecha_pago = $_POST['fecha_pago'] ?? '';
    insertarPago($deudor, $cuota, $cuota_capital, $fecha_pago);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


$pagos = obtenerPagos();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laboratorio 1</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

<div class= "caja">
<div class="container">
<h2>Formulario de Registro de Pagos</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    Deudor: <input type="text" name="deudor" required><br>
    Cuota: <input type="number" name="cuota" required><br>
    Cuota Capital: <input type="number" step="0.01" name="cuota_capital" required><br>
    Fecha de Pago: <input type="date" name="fecha_pago" required><br>
    <input type="submit" value="Registrar Pago">
</form>
</div>

<h2>Listado de Pagos</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Deudor</th>
        <th>Cuota</th>
        <th>Cuota Capital</th>
        <th>Fecha de Pago</th>
    </tr>
    <?php
    if (!empty($pagos)) {
        foreach ($pagos as $pago) {
            echo "<tr><td>" . htmlspecialchars((string)$pago["id"] ?? '') . "</td><td>" . htmlspecialchars($pago["deudor"] ?? '') . "</td><td>" . htmlspecialchars((string)$pago["cuota"] ?? '') . "</td><td>" . htmlspecialchars((string)$pago["cuota_capital"] ?? '') . "</td><td>" . htmlspecialchars($pago["fecha_pago"] ?? '') . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No existen pagos</td></tr>";
    }
    ?>
</table>
</div>

</body>
</html>
