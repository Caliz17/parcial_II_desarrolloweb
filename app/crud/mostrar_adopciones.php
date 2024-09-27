<?php
include '../components/navbar.php';
include 'db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Mostrar Adopciones</title>
</head>
<body>

    <div class="container">
        <h1>Adopciones Registradas</h1>

        <?php
        $sql = "
            SELECT propietario.nombre AS propietario_nombre, mascota.nombre AS mascota_nombre, mascota.tipo 
            FROM propietario
            JOIN mascota ON propietario.id = mascota.propietario_id
            WHERE mascota.adoptada = 1
        ";

        $result = $conn->query($sql);

        if ($result === false) {
            echo "Error en la consulta: " . $conn->error;
        } else {
            if ($result->num_rows > 0) {
                echo "<table class='table'>";
                echo "<thead><tr><th>Propietario</th><th>Mascota</th><th>Tipo</th></tr></thead>";
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["propietario_nombre"]) . "</td>
                            <td>" . htmlspecialchars($row["mascota_nombre"]) . "</td>
                            <td>" . htmlspecialchars($row["tipo"]) . "</td>
                          </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No hay adopciones registradas.</p>";
            }
        }

        $conn->close();
        ?>
    </div>

</body>
</html>
