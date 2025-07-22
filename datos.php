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

// Función para eliminar una película
function eliminarPelicula($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM peliculas WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Función para actualizar una película
function actualizarPelicula($conn, $id, $nombre, $telefono, $tipo) {
    $stmt = $conn->prepare("UPDATE peliculas SET nombre = ?, telefono = ?, tipo = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nombre, $telefono, $tipo, $id);
    return $stmt->execute();
}

// Manejo de eliminación
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    if (eliminarPelicula($conn, $delete_id)) {
        echo "<script>alert('Película eliminada exitosamente.');</script>";
    } else {
        echo "<script>alert('Error al eliminar la película.');</script>";
    }
}

// Manejo de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $tipo = $_POST['tipo'];

    if (actualizarPelicula($conn, $update_id, $nombre, $telefono, $tipo)) {
        echo "<script>alert('Película actualizada exitosamente.');</script>";
    } else {
        echo "<script>alert('Error al actualizar la película.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Películas</title>
    <style>
        /* CSS mejorado */
        body {
            font-family: 'Arial', sans-serif;
            background: url('img/pelicula.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            text-align: center;
            margin-top: 30px;
        }

        h1 {
            color: #f39c12;
        }

        h2 {
            color: #ecf0f1;
        }

        form, table {
            width: 80%;
            margin: 20px auto;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
        }

        form label {
            font-size: 18px;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #7f8c8d;
            border-radius: 5px;
            background-color: #34495e;
            color: white;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #c0392b;
        }

        table {
            border-collapse: collapse;
            background-color: #34495e;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ecf0f1;
        }

        th {
            background-color: #e74c3c;
        }

        td {
            background-color: #7f8c8d;
        }

        td[colspan="5"] {
            text-align: center;
            color: #ecf0f1;
        }

        .actions a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            background-color: #e74c3c;
            border-radius: 5px;
        }

        .actions a:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h1>Registrar Película</h1>
    <form action="datos.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="telefono">Teléfono:</label>
        <input type="number" id="telefono" name="telefono" required>

        <label for="tipo">Tipo (género):</label>
        <input type="text" id="tipo" name="tipo" required>

        <input type="submit" value="Registrar">
    </form>

    <h2>Películas Registradas</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>

        <?php
        // Mostrar registros
        $sql = "SELECT * FROM peliculas";
        $result = $conn->query($sql);
        $sql = "INSERT INTO peliculas (id, nombre, telefono, tipo) 
                    VALUES (' $id','$nombre', '$telefono', '$tipo)";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['telefono']}</td>
                        <td>{$row['tipo']}</td>
                        <td class='actions'>
                            <a href='?delete_id={$row['id']}' onclick='return confirm(\"¿Estás seguro de eliminar esta película?\")'>Eliminar</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay películas registradas.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>





