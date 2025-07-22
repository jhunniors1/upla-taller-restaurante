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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['procesar_compra'])) {
    // Verificar si el carrito está vacío
    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        // Insertar cada venta en la base de datos
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
                echo "<p>Venta registrada exitosamente para la película: $pelicula</p>";
            } else {
                echo "<p>Error al registrar la venta: " . $conn->error . "</p>";
            }
        }

        // Limpiar el carrito después de procesar la compra
        unset($_SESSION['carrito']);
        echo "<p>¡Compra procesada exitosamente!</p>";

    } else {
        echo "<p>No hay productos en el carrito para procesar.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Compra</title>
    <style>
        /* Estilos generales */
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

        .mensaje {
            text-align: center;
            font-size: 1.5em;
            color: #27ae60;
        }

        .mensaje-error {
            text-align: center;
            font-size: 1.5em;
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <h1>Compra Procesada</h1>
    <div class="mensaje">
        <?php 
        // Mensaje cuando la compra se procesa
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['procesar_compra'])) {
            echo "Compra realizada exitosamente. ¡Gracias por tu compra!";
        }
        ?>
    </div>
    <a href="ventas.php" class="boton">Volver al inicio</a>
</body>
</html>
