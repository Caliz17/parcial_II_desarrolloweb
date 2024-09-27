<?php
ob_start();
include '../components/navbar.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear'])) {
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];

    $sql = "INSERT INTO mascota (nombre, tipo) VALUES ('$nombre', '$tipo')";
    $conn->query($sql);
}

if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM mascota WHERE id='$id'";
    $conn->query($sql);
    header("Location: crud_mascotas.php");
    exit;
}

$mascota = null;
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $sql = "SELECT * FROM mascota WHERE id='$id'";
    $result = $conn->query($sql);
    $mascota = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];

    $sql = "UPDATE mascota SET nombre='$nombre', tipo='$tipo' WHERE id='$id'";
    $conn->query($sql);
    header("Location: crud_mascotas.php");
    exit;
}

$sql = "SELECT * FROM mascota";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>CRUD Mascotas</title>
</head>
<body>
    <h1>Registro de Mascotas</h1>

    <form action="crud_mascotas.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" required>
        <button type="submit" name="crear">Registrar Mascota</button>
    </form>

    <h2>Lista de Mascotas</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["nombre"] . "</td>
                    <td>" . $row["tipo"] . "</td>
                    <td>
                        <a href='?editar=" . $row["id"] . "'>Editar</a>
                        <a href='?eliminar=" . $row["id"] . "' onclick='return confirm(\"¿Estás seguro de eliminar esta mascota?\");'>Eliminar</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay mascotas registradas.</td></tr>";
        }
        ?>
    </table>

    <?php if ($mascota): ?>
        <h2>Editar Mascota</h2>
        <form action="crud_mascotas.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $mascota['id']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $mascota['nombre']; ?>" required>
            <label for="tipo">Tipo:</label>
            <input type="text" name="tipo" value="<?php echo $mascota['tipo']; ?>" required>
            <button type="submit" name="actualizar">Actualizar Mascota</button>
        </form>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
ob_end_flush();
?>
