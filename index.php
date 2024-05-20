<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renta de Carros</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Renta de Carros</h1>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Vehículos</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Sobre Nosotros</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="hero">
            <h2>Encuentra el auto perfecto para tu viaje</h2>
            <form action="search.php" method="GET">
                <label for="pickup-location">Lugar de recogida:</label>
                <input type="text" id="pickup-location" name="pickup-location" required>

                <label for="dropoff-location">Lugar de entrega:</label>
                <input type="text" id="dropoff-location" name="dropoff-location" required>

                <label for="pickup-date">Fecha de recogida:</label>
                <input type="date" id="pickup-date" name="pickup-date" required>

                <label for="dropoff-date">Fecha de entrega:</label>
                <input type="date" id="dropoff-date" name="dropoff-date" required>

                <button type="submit">Buscar</button>
            </form>
        </section>
        <section class="cars-list">
            <h2>Vehículos Disponibles</h2>
            <!-- Aquí se listarían los vehículos disponibles -->
            <?php
            // Aquí podrías conectar a una base de datos y mostrar los autos disponibles
            ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Renta de Carros. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
