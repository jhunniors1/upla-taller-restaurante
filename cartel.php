<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera de Cine</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #121212;
            color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 30px auto;
            padding: 30px;
            background-color: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        }
        h1 {
            color: #ff8c00;
            font-size: 2.5em;
            text-align: center;
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
            border: 1px solid #333;
            vertical-align: middle;
        }
        th {
            background-color: #ff8c00;
            color: #121212;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #2c2c2c;
        }
        tr:hover {
            background-color: #3a3a3a;
        }
        .movie-name {
            font-weight: bold;
            color: #ff8c00;
        }
        .price {
            font-size: 1.2em;
            color: #ffd700;
        }
        .showtime {
            font-style: italic;
            color: #aaa;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        .btn-back {
            display: inline-block;
            padding: 12px 25px;
            font-size: 1em;
            color: #121212;
            background-color: #ff8c00;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-back:hover {
            background-color: #ffa733;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cartelera de Cine</h1>
        <table>
            <thead>
                <tr>
                    <th>Película</th>
                    <th>Horario</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="movie-name">El Viaje Fantástico</td>
                    <td class="showtime">12:00 PM, 5:00 PM, 8:30 PM</td>
                    <td class="price">$8.00</td>
                </tr>
                <tr>
                    <td class="movie-name">La Aventura Eterna</td>
                    <td class="showtime">1:30 PM, 6:30 PM, 9:00 PM</td>
                    <td class="price">$9.00</td>
                </tr>
                <tr>
                    <td class="movie-name">El Último Guerrero</td>
                    <td class="showtime">2:00 PM, 4:30 PM, 7:30 PM</td>
                    <td class="price">$7.50</td>
                </tr>
                <tr>
                    <td class="movie-name">El Secreto del Bosque</td>
                    <td class="showtime">3:00 PM, 6:00 PM, 9:15 PM</td>
                    <td class="price">$8.50</td>
                </tr>
                <tr>
                    <td class="movie-name">El Regreso de los Héroes</td>
                    <td class="showtime">4:00 PM, 7:00 PM, 9:45 PM</td>
                    <td class="price">$10.00</td>
                </tr>
            </tbody>
        </table>
        <div class="btn-container">
            <a href="principal.php" class="btn-back">Volver al Principal</a>
        </div>
    </div>
</body>
</html>
