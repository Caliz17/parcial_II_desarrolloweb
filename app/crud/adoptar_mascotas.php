<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $propietario_id = $_POST['propietario_id'];
    $mascota_id = $_POST['mascota_id'];

    $sql = "UPDATE mascota SET propietario_id = ?, adoptada = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $propietario_id, $mascota_id);

    if ($stmt->execute()) {
        $mensaje = "Mascota adoptada con éxito.";
    } else {
        $mensaje = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Adoptar Mascota</title>
</head>
<body>
<?php include '../components/navbar.php'; ?>
<div class="container">
    <h1>Adoptar Mascota</h1>

    <?php if (isset($mensaje)): ?>
        <div class="alert">
            <p><?php echo $mensaje; ?></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="adoptar_mascotas.php">
        <label for="propietario_id">ID Propietario:</label>
        <input type="number" name="propietario_id" id="propietario_id" required>

        <label for="mascota_id">ID Mascota:</label>
        <input type="number" name="mascota_id" id="mascota_id" required>

        <input type="submit" value="Adoptar Mascota">
    </form>
</div>
</body>
</html>
