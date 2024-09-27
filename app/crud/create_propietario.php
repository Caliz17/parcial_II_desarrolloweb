<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "INSERT INTO propietario (nombre, email, telefono, direccion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $email, $telefono, $direccion);

    if ($stmt->execute()) {
        echo "<div class='container'><p>Nuevo propietario creado con éxito</p></div>";
    } else {
        echo "<div class='container'><p>Error: " . $stmt->error . "</p></div>";
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
    <title>Crear Propietario</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<?php include '../components/navbar.php'; ?>
<div class="container">
    <h1>Crear Propietario</h1>
    <form method="POST" action="create_propietario.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" required>
        
        <label for="direccion">Dirección:</label>
        <textarea name="direccion" id="direccion" required></textarea>
        
        <input type="submit" value="Crear Propietario">
    </form>
</div>

</body>
</html>
