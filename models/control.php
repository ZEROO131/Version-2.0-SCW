<?php
require_once('conexion.php');

// 🔴 PROCESO DE RECUPERACIÓN DE CONTRASEÑA
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == "recuperar") {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        restablecerContrasena($_POST['email']);
    } else {
        echo "<script>alert('El correo no puede estar vacío.'); window.location.href='../views/vrecuperar.php';</script>";
    }
    exit();
}

// 🔴 PROCESO PARA CAMBIAR LA CONTRASEÑA DESDE EL TOKEN
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token']) && isset($_POST['nueva_contraseña'])) {
    restablecerContrasena($_POST['token'], $_POST['nueva_contraseña']);
}

// 🔴 PROCESO DE INICIO DE SESIÓN
$usu = isset($_POST['usu']) ? $_POST['usu'] : NULL;
$pas = isset($_POST['pss']) ? $_POST['pss'] : NULL;

if ($usu && $pas) {
    valida($usu, $pas);
} else {
    red();
}

// 🔴 FUNCIÓN PARA VALIDAR USUARIO Y CONTRASEÑA
function valida($usu, $pas) {
    $res = ingr($usu, $pas);
    $res = isset($res) ? $res : NULL;

    if ($res) {
        session_start();
        $_SESSION['idusu'] = $res[0]['idusu'];
        $_SESSION['nomusu'] = $res[0]['nomusu'];
        $_SESSION['apeusu'] = $res[0]['apeusu'];
        $_SESSION['idper'] = $res[0]['idper'];
        $_SESSION['nomper'] = $res[0]['nomper'];
        $_SESSION['aut'] = '1011322322#2006'; // Llave de autenticación

        // Obtener la página inicial de acuerdo al perfil
        $paginaInicial = obtenerPaginaInicial($_SESSION['idper']);
        if ($paginaInicial) {
            echo "<script>window.location='../home.php?pg=$paginaInicial';</script>";
        } else {
            echo "<script>window.location='../home.php';</script>";
        }
        exit();
    } else {
        red();
    }
}

// 🔴 FUNCIÓN PARA REDIRIGIR EN CASO DE ERROR
function red() {
    echo "<script>window.location='../index.php?pg=1002&err=oK';</script>";
}

// 🔴 FUNCIÓN PARA VERIFICAR EL USUARIO EN LA BASE DE DATOS
function ingr($usu, $pas) {
    $res = NULL;
    $pas = sha1(md5($pas . 'Jd#')); // Encriptación de la contraseña

    $sql = "SELECT u.idusu, u.nomusu, u.apeusu, u.emailusu, u.idper, p.nomper 
            FROM usuario AS u 
            INNER JOIN perfil AS p ON u.idper = p.idper 
            WHERE u.emailusu = :emailusu AND u.paswusu = :paswusu";

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);

    $result->bindParam(":emailusu", $usu);
    $result->bindParam(":paswusu", $pas);
    $result->execute();

    $res = $result->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}

// 🔴 FUNCIÓN PARA OBTENER LA PÁGINA INICIAL SEGÚN EL PERFIL
function obtenerPaginaInicial($idPerfil) {
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();

    $sql = "SELECT pagini FROM perfil WHERE idper = :idper";
    $result = $conexion->prepare($sql);
    $result->bindParam(":idper", $idPerfil);
    $result->execute();

    $data = $result->fetch(PDO::FETCH_ASSOC);
    return $data ? $data['pagini'] : null;
}

// 🔴 FUNCIÓN PARA PROCESAR LA RECUPERACIÓN DE CONTRASEÑA
function restablecerContrasena($email) {
    $pdo = (new Conexion())->get_conexion();
    
    // 🔹 Verificar si el usuario existe
    $stmt = $pdo->prepare("SELECT idusu FROM usuario WHERE emailusu = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "<script>alert('Este correo no está registrado.'); window.location.href='../views/vrecuperar.php';</script>";
        exit();
    }

    // 🔹 Generar token único
    $token = bin2hex(random_bytes(32));
    $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // 🔹 Guardar token en la base de datos
    $stmt = $pdo->prepare("INSERT INTO token (emailusu, token, expiracion) VALUES (?, ?, ?)");
    $stmt->execute([$email, $token, $expiracion]);

    // 🔹 Enviar correo con el enlace de recuperación
    $link = "http://localhost/S.CARWASH/views/cambiar_contrasena.php?token=$token";
    $asunto = "Recuperación de contraseña";
    $mensaje = "Haz clic en el siguiente enlace para restablecer tu contraseña: $link";
    $cabeceras = "From: soporte@scarwash.com\r\n";

    mail($email, $asunto, $mensaje, $cabeceras);

    echo "<script>alert('Se ha enviado un enlace a tu correo electrónico.'); window.location.href='../index.php';</script>";
}

// 🔴 FUNCIÓN PARA CAMBIAR LA CONTRASEÑA USANDO EL TOKEN
function cambiarContrasena($token, $nueva_contraseña) {
    $pdo = (new Conexion())->get_conexion();

    // 🔹 Verificar si el token es válido y no ha expirado
    $stmt = $pdo->prepare("SELECT emailusu FROM token WHERE token = ? AND expiracion > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        $emailusu = $user['emailusu'];
        $hashed_password = sha1(md5($nueva_contraseña . 'Jd#'));

        // 🔹 Actualizar la contraseña
        $stmt = $pdo->prepare("UPDATE usuario SET paswusu = ? WHERE emailusu = ?");
        $stmt->execute([$hashed_password, $emailusu]);

        // 🔹 Eliminar el token usado
        $stmt = $pdo->prepare("DELETE FROM token WHERE token = ?");
        $stmt->execute([$token]);

        echo "<script>alert('Contraseña actualizada con éxito.'); window.location.href='../index.php';</script>";
    } else {
        echo "<script>alert('El token no es válido o ha expirado.'); window.location.href='../index.php';</script>";
    }
}
?>
