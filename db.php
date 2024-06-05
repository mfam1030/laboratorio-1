<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tarea";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


function insertarPago($deudor, $cuota, $cuota_capital, $fecha_pago) {
    global $db;
    $stmt = $db->prepare("INSERT INTO pagos (deudor, cuota, cuota_capital, fecha_pago) VALUES (:deudor, :cuota, :cuota_capital, :fecha_pago)");
    $stmt->bindParam(':deudor', $deudor);
    $stmt->bindParam(':cuota', $cuota);
    $stmt->bindParam(':cuota_capital', $cuota_capital);
    $stmt->bindParam(':fecha_pago', $fecha_pago);
    $stmt->execute();
}


function obtenerPagos() {
    global $db;
    $stmt = $db->prepare("SELECT * FROM pagos");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
