<?php require_once 'models/conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>
<body>



 <div class="wrapper">

<!----------------------------- Form box ----------------------------------->       
<div class="forms-box">
        
        <!------------------- login form -------------------------->
    <form action="models/control.php" method="POST">
        <div class="login-container" id="login">
            <div class="top">
                <span>No tienes cuenta? <a href="#" onclick="register()">Registrate</a></span>
                <header>Ingresa</header>
            </div>
            <div class="input-box" style="margin-bottom: 5px;">
                <input type="text" class="input-field" placeholder="Email" name="usu" id="email" required>
                <i class="bx bx-user"></i>
                <div id="email-error" style="color: red; display: none;">Debe ingresar un correo válido (con '@').</div>
            </div>
            <div class="input-box" style="margin-bottom: 5px;">
                <input type="password" class="input-field" placeholder="Contraseña" name="pss">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Ingresar">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check">
                    <label for="login-check"> Recuerdame</label>
                </div>
                <div class="two">
                    <label><a href="#">Olvidaste tu contraseña?</a></label>
                </div>
            </div>
            <?php
    if (isset($_GET['err']) && $_GET['err'] == 'oK') {
        echo "<div class='alert alert-danger' role='alert'>Usuario o contraseña incorrectos. Intenta de nuevo.</div>";
    }
    ?> 
        </div>

    </form>

        <!------------------- registration form -------------------------->
        <div class="register-container" id="register">
            <div class="top">
                <span>Tienes cuenta? <a href="#" onclick="login()">Ingresa</a></span>
                <header>Registrate</header>
            </div>
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Nombre">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Apellido">
                    <i class="bx bx-user"></i>
                </div>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Email">
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Contraseña">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Registrate">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="register-check">
                    <label for="register-check"> Recuerdame</label>
                </div>
                <div class="two">
                    <label><a href="#">Terminos y condiciones</a></label>
                </div>
            </div>
        </div>
    </div>
</div>   

<script>
   
   function myMenuFunction() {
    var i = document.getElementById("navMenu");

    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }
 
</script>

<script>

    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }

</script>

<script>
    // Obtener el campo de correo y el mensaje de error
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('email-error');

    // Función que verifica si el correo contiene el símbolo "@"
    emailInput.addEventListener('input', function() {
        if (emailInput.value.includes('@')) {
            emailError.style.display = 'none'; // Oculta el mensaje si tiene "@"
        } else {
            emailError.style.display = 'block'; // Muestra el mensaje si no tiene "@"
        }
    });
</script>
</body>
</html>