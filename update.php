<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cine";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID de la película a actualizar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM peliculas WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row["nombre"];
        $telefono = $row["telefono"];
        $tipo = $row["tipo"];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $tipo = $_POST['tipo'];

    $sql = "UPDATE peliculas SET nombre = '$nombre', telefono = '$telefono', tipo = '$tipo' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Película actualizada exitosamente";
        header("Location: datos.php"); // Redirige de nuevo a la página principal
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Película</title>
    <style>
        /* Mantenemos los mismos estilos de antes */
    </style>
</head>
<body>
    <h1>Actualizar Película</h1>
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>

        <label for="telefono">Telefono:</label>
        <input type="number" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required>

        <label for="tipo">Tipo (género):</label>
        <input type="text" id="tipo" name="tipo" value="<?php echo $tipo; ?>" required>

        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
