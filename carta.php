<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Cine - Canchita y Gaseosas</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #ff6347;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            vertical-align: middle;
        }
        th {
            background-color: #ff6347;
            color: #fff;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .product {
            text-transform: uppercase;
            font-weight: bold;
        }
        .description {
            font-style: italic;
            color: #666;
        }
        .price {
            font-size: 1.2em;
            color: #ff6347;
        }
        img {
            width: 80px;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Carta de Cine - Canchita y Gaseosas</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Producto</th>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td><img src="img/canchita_pequeña.png" alt="Canchita Pequeña"></td>
                    <td>Canchita Pequeña</td>
                    <td>Porción pequeña de palomitas</td>
                    <td>$3.50</td>
                </tr>
                <tr>
                    <td>002</td>
                    <td><img src="img/canchita_grande.jpeg" alt="Canchita Grande"></td>
                    <td>Canchita Grande</td>
                    <td>Porción grande de palomitas</td>
                    <td>$5.00</td>
                </tr>
                
                <tr>
                    <td>004</td>
                    <td><img src="img/gaseosa_pequeña.jpeg" alt="Gaseosa Pequeña"></td>
                    <td>Gaseosa Pequeña</td>
                    <td>Refresco en vaso pequeño</td>
                    <td>$2.00</td>
                </tr>
                <tr>
                    <td>005</td>
                    <td><img src="img/peque.jpeg" alt="Gaseosa Grande"></td>
                    <td>Gaseosa Grande</td>
                    <td>Refresco en vaso grande</td>
                    <td>$3.50</td>
                </tr>
                <tr>
                    <td>006</td>
                    <td><img src="img/combinado.jpg" alt="Combinado"></td>
                    <td>Combinado (Canchita + Gaseosa)</td>
                    <td>Canchita pequeña con gaseosa pequeña</td>
                    <td>$4.50</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

