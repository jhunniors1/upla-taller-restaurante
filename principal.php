<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="estiloprincipal.css">
</head>
<body>

    <h1>Bienvenido a la Página Principal</h1>
    <div class="menu">
        <button onclick="navigate('carta.php')">CARTA</button>
        <button onclick="navigate('cartelera.php')">CARTELERA DE PELICULAS</button>
        <button onclick="navigate('ventas.php')">REALIZAR COMPRA</button>
        <button onclick="navigate('datos.php')">DATOS</button>
    </div>

    <script>
        function navigate(page) {
            window.location.href = page;
        }
    </script>

</body>
</html>
