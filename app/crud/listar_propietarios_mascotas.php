<?php
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Propietarios y Mascotas</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<?php include '../components/navbar.php'; ?>
<div class="container">
    <h1>Propietarios</h1>
    <?php
    $result = $conn->query("SELECT * FROM propietario");
    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>ID</th><th>Nombre</th><th>Email</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["email"] . "</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No hay propietarios registrados.</p>";
    }
    ?>

    <h1>Mascotas Disponibles para Adopción</h1>
    <?php
    $result = $conn->query("SELECT * FROM mascota WHERE adoptada = 0");
    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>ID</th><th>Nombre</th><th>Tipo</th><th>Edad</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["tipo"] . "</td><td>" . $row["edad"] . "</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No hay mascotas disponibles para adopción.</p>";
    }
    $conn->close();
    ?>
</div>

</body>
</html>
