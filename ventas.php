<?php
session_start(); // Iniciar la sesión para el carrito

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cine";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario de venta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pelicula = $_POST['pelicula'] ? $_POST['pelicula'] : 0;
    $precio_boleto = $_POST['precio_boleto']? $_POST['precio_boleto'] : 0;
    $cantidad = $_POST['cantidad']? $_POST['cantidad'] : 0;
    $canchita = isset($_POST['canchita']) ? $_POST['canchita'] : 0;
    $refresco = isset($_POST['refresco']) ? $_POST['refresco'] : 0;
    $precio_total = ($precio_boleto * $cantidad) + $canchita + $refresco;

    // Crear un array con los datos de la venta
    $venta = [
        'pelicula' => $pelicula,
        'precio_boleto' => $precio_boleto,
        'cantidad' => $cantidad,
        'canchita' => $canchita,
        'refresco' => $refresco,
        'precio_total' => $precio_total
    ];

    // Guardar la venta en la sesión (carrito)
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    $_SESSION['carrito'][] = $venta;
}

// Eliminar venta del carrito
if (isset($_GET['eliminar_carrito'])) {
    $index = $_GET['eliminar_carrito'];
    unset($_SESSION['carrito'][$index]);
    $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar el array
}

// Procesar la compra y guardarla en la base de datos
if (isset($_POST['procesar_compra'])) {
    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        $total_compra = 0;

        // Guardar la venta en la base de datos
        foreach ($_SESSION['carrito'] as $venta) {
            $pelicula = $venta['pelicula'];
            $precio_boleto = $venta['precio_boleto'];
            $cantidad = $venta['cantidad'];
            $canchita = $venta['canchita'];
            $refresco = $venta['refresco'];
            $precio_total = $venta['precio_total'];

            // Insertar datos en la base de datos
            $sql = "INSERT INTO ventas (pelicula, precio_boleto, cantidad, canchita, refresco, precio_total) 
                    VALUES ('$pelicula', '$precio_boleto', '$cantidad', '$canchita', '$refresco', '$precio_total')";

            if ($conn->query($sql) === TRUE) {
                echo "Venta registrada exitosamente";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Acumular el total de la compra
            $total_compra += $precio_total;
        }

        // Limpiar el carrito después de procesar la compra
        unset($_SESSION['carrito']);

        // Mostrar la boleta de venta
        echo "<h2>Boleta de Venta</h2>";
        echo "<div style='border: 2px solid #000; padding: 20px; max-width: 600px; margin: 0 auto;'>";
        echo "<h3 style='text-align: center;'>Cine XYZ</h3>";
        echo "<p><strong>Fecha:</strong> " . date("Y-m-d H:i:s") . "</p>";
        echo "<p><strong>Cliente:</strong> Cliente No. " . rand(1000, 9999) . "</p>";
        echo "<table border='1' cellpadding='5' style='width: 100%; margin-top: 20px; border-collapse: collapse;'>";
        echo "<tr><th>Película</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th></tr>";

        // Imprimir detalles de las ventas
        foreach ($_SESSION['carrito'] as $venta) {
            echo "<tr>
                    <td>" . $venta['pelicula'] . "</td>
                    <td>" . $venta['cantidad'] . "</td>
                    <td>" . $venta['precio_boleto'] . "</td>
                    <td>" . $venta['precio_total'] . "</td>
                  </tr>";
        }

        // Mostrar total de la compra
        echo "<tr>
                <td colspan='3' style='text-align: right;'><strong>Total</strong></td>
                <td><strong>S/. " . $total_compra . "</strong></td>
              </tr>";

        echo "</table>";
        echo "<p style='text-align: center;'>Gracias por su compra!</p>";
        echo "<button onclick='window.print()' style='background-color: #3498db; color: white; padding: 10px 20px; border: none; cursor: pointer;'>Imprimir Boleta</button>";
        echo "</div>";
    } else {
        echo "<p style='color: red; text-align: center;'>No hay productos en el carrito para procesar la compra.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ventas de Cine</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('img/fondo_peli.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #f39c12;
            padding-top: 30px;
            font-size: 3em;
        }

        h2 {
            text-align: center;
            color: #ecf0f1;
            margin-top: 30px;
            font-size: 2em;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: 0 auto;
        }

        label {
            margin-bottom: 10px;
            font-size: 18px;
        }

        input, select {
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background-color: #34495e;
            color: white;
        }

        input[type="submit"] {
            background-color: #e74c3c;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #c0392b;
        }

        table {
            width: 90%;
            margin: 50px auto;
            border-collapse: collapse;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ecf0f1;
        }

        th {
            background-color: #e74c3c;
        }

        td {
            background-color: #7f8c8d;
        }

        td[colspan="7"] {
            text-align: center;
            color: #ecf0f1;
        }

        .boton {
            background-color: #3498db;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            text-decoration: none;
        }

        .boton:hover {
            background-color: #2980b9;
        }

        .boton-eliminar {
            background-color: #e74c3c;
        }

        .boton-eliminar:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h1>Registro de Venta de Película</h1>
    <form action="ventas.php" method="POST">
        <label for="pelicula">Nombre de la Película:</label>
        <select id="pelicula" name="pelicula" required>
            <option value="Pelicula 1">Pelicula 1</option>
            <option value="Pelicula 2">Pelicula 2</option>
            <option value="Pelicula 3">Pelicula 3</option>
        </select>

        <label for="precio_boleto">Precio del Boleto:</label>
        <input type="number" id="precio_boleto" name="precio_boleto" required onchange="calcularTotal()">

        <label for="cantidad">Cantidad de Boletos:</label>
        <input type="number" id="cantidad" name="cantidad" required onchange="calcularTotal()">

        <label for="canchita">Canchita (S/.):</label>
        <select id="canchita" name="canchita" onchange="calcularTotal()">
            <option value="0">Sin Canchita</option>
            <option value="5">Canchita Grande (S/. 5)</option>
            <option value="3">Canchita Mediana (S/. 3)</option>
        </select>

        <label for="refresco">Refresco (S/.):</label>
        <select id="refresco" name="refresco" onchange="calcularTotal()">
            <option value="0">Sin Refresco</option>
            <option value="4">Refresco Grande (S/. 4)</option>
            <option value="2">Refresco Pequeño (S/. 2)</option>
        </select>

        <label for="precio_total">Precio Total (S/.):</label>
        <input type="text" id="precio_total" name="precio_total" readonly>

        <input type="submit" value="Agregar al Carrito">
    </form>

    <h2>Carrito de Compras</h2>
    <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
    <table>
        <tr>
            <th>Película</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Canchita</th>
            <th>Refresco</th>
            <th>Precio Total</th>
            <th>Acciones</th>
        </tr>
        <?php
        foreach ($_SESSION['carrito'] as $index => $venta) {
            echo "<tr>
                    <td>" . $venta['pelicula'] . "</td>
                    <td>" . $venta['precio_boleto'] . "</td>
                    <td>" . $venta['cantidad'] . "</td>
                    <td>" . $venta['canchita'] . "</td>
                    <td>" . $venta['refresco'] . "</td>
                    <td>" . $venta['precio_total'] . "</td>
                    <td><a href='ventas.php?eliminar_carrito=$index' class='boton boton-eliminar'>Eliminar</a></td>
                  </tr>";
        }
        ?>
    </table>
    <form action="ventas.php" method="POST">
        <input type="submit" name="procesar_compra" value="Procesar Compra" class="boton">
    </form>
    <?php else: ?>
        <p style="color: red; text-align: center;">Tu carrito está vacío. Agrega productos para realizar la compra.</p>
    <?php endif; ?>
</body>
</html>






