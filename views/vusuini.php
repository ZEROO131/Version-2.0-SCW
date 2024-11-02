<div class="allsec">
    <div class="sec1 glass-effect">
        <h1>Sección 1</h1>
        <?php 
            // Iniciar la sesión si aún no está iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Verificar si hay un usuario logueado
            if (isset($_SESSION['nomusu']) && isset($_SESSION['apeusu'])) {
                $nombreUsuario = $_SESSION['nomusu'];
                $apellidoUsuario = $_SESSION['apeusu'];
                echo "<h2 style='color: white;'>Bienvenido, $nombreUsuario $apellidoUsuario!</h2>";
            } else {
                echo "<h2 style='color: white;'>Bienvenido, invitado!</h2>";
            }
        ?>
        <div class="carusu">
            <!-- carro del usuario -->
            <img src="img/audir.png" alt="Imagen de auto">
            <!-- placa del vehiculo -->
            <?php 
                // Verificar si hay una placa de vehículo almacenada en la sesión
                if (isset($_SESSION['placa'])) {
                    $placaVehiculo = $_SESSION['placa'];
                    echo "<p style='color: white;'>Placa del vehículo: $placaVehiculo</p>";
                } else {
                    echo "<p style='color: white;'>No hay vehículo registrado.</p>";
                }
            ?>
        </div>
    </div>

    <div class="sec2">
        <h1>Sección 2</h1>
    </div>
</div>
