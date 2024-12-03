<style>
.containeremp {
    width: 90%;
    max-width: 900px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    flex: 1; 
}

h1.emp {
    text-align: center;
    margin-bottom: 30px;
    font-size: 2.5em;
    color: #2c3e50;
    font-weight: bold;
}

.accordion-emp, .accordion-service-emp {
    background-color: #3498db;
    color: white;
    cursor: pointer;
    padding: 15px;
    width: 100%;
    text-align: left;
    border: none;
    outline: none;
    font-size: 1.5em;
    margin-bottom: 10px;
    border-radius: 8px;
    transition: 0.4s;
}

.accordion-emp:hover, .accordion-service-emp:hover {
    background-color: #2980b9;
}

.accordion-emp.active, .accordion-service-emp.active {
    background-color: #2c3e50;
}

.panel-emp, .panel-service {
    padding: 0 15px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}

.section-content p {
    margin: 10px 0;
}
</style>

<?php 
    include("controllers/cemple.php"); // Controlador para empleados
    include("controllers/csoli.php"); // Controlador para solicitudes
    include("controllers/cserv.php"); // Controlador para servicios
?>
<br>
<br>
<br>
<div class="containeremp">
    <h1 class="emp">Perfil de Empleado</h1>

    <?php if ($dmOne): ?>
        <!-- Aquí se muestra la información de un solo empleado -->
        <button class="accordion-emp">Detalles de Servicio</button>
        <div class="panel-emp">
            <div class="section-content">
                <table border="0">
                    <tr>
                        <td><strong>Nombre:</strong></td>
                        <td><?php echo $dmOne[0]['$nomemple']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Documento:</strong></td>
                        <td><?php echo $dmOne[0]['ndocemple']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Sucursal:</strong></td>
                        <td><?php echo $dmOne[0]['direemple']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <button class="accordion-emp">Detalles de Movimiento</button>
        <div class="panel-emp">
            <div class="section-content">
                <table border="0">
                    <tr>
                        <td><strong>Último servicio realizado:</strong></td>
                        <td><?php echo $dmOne[0][' '];  ?></td>
                    </tr>
                    <tr>
                        <td><strong>Detalles:</strong></td>
                        <td><?php echo $dmOne[0]['detsoli']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Cliente:</strong></td>
                        <td><?php echo $dmOne[0]['idclien'];  ?></td>
                    </tr>
                    <tr>
                        <td><strong>Monto:</strong></td>
                        <td><?php echo $dmOne[0]['precio'];  ?></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php else: ?>
        <p>No se encontraron datos para este empleado.</p>
    <?php endif; ?>
</div>

    <script>
        // Manejo de los botones principales (Detalles de Servicio y Detalles de Movimiento)
var acc = document.getElementsByClassName("accordion-emp");
for (var i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}

// Manejo del botón "Último servicio realizado"
var accService = document.getElementsByClassName("accordion-service-emp");
for (var i = 0; i < accService.length; i++) {
    accService[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panelService = this.nextElementSibling;
        if (panelService.style.maxHeight) {
            panelService.style.maxHeight = null;
        } else {
            panelService.style.maxHeight = panelService.scrollHeight + "px";
        }
    });
}

    </script>