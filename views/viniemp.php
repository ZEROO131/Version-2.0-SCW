<style>
    .menu-container {
    color: #fff;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
}

.menu-grid {
    display: flex;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    width: 90%;
    height: 30%;
}

.menu-button {
    background-color: rgba(255, 255, 255, 0.9);
    color: #333;
    font-size: 24px;
    padding: 40px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    font-weight: bold;
}

.menu-button:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
}

</style>

<div class="menu-container">
    <div class="menu-grid">
        <a href="home.php?pg=2002" class="menu-button menu-button-primary">Crear Empleados<br>y Servicios</a>
        <a href="home.php?pg=2003" class="menu-button menu-button-success">Registrar Vehículos</a>
        <a href="home.php?pg=2004" class="menu-button menu-button-warning">Asignar Servicios<br>y Solicitar Servicios</a>
        <a href="home.php?pg=2005" class="menu-button menu-button-info">Historial de Servicios</a>
    </div>
</div>

