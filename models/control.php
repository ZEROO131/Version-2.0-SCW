<?php
require_once('conexion.php');

// Verificar si se quiere cerrar sesión
if (isset($_GET['cerrar_sesion']) && $_GET['cerrar_sesion'] == 'true') {
    cerrarSesion();
}

// Procesar recuperación de contraseña
if (isset($_POST['token']) && isset($_POST['nueva_contraseña'])) {
    restablecerContrasena($_POST['token'], $_POST['nueva_contraseña']);
}

// Obtener datos del formulario
$usu = isset($_POST['usu']) ? $_POST['usu'] : NULL;
$pas = isset($_POST['pss']) ? $_POST['pss'] : NULL;

if ($usu && $pas) {
    valida($usu, $pas);
} else {
    red();
}

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

function red() {
    echo "<script>window.location='../index.php?pg=1002&err=oK';</script>";
}

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

function restablecerContrasena($token, $nueva_contraseña) {
    $pdo = (new Conexion())->get_conexion();
    $stmt = $pdo->prepare("SELECT emailusu FROM token WHERE token = ? AND expiracion > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        $emailusu = $user['emailusu'];
        $hashed_password = sha1(md5($nueva_contraseña . 'Jd#')); // Usar misma encriptación que en login

        $stmt = $pdo->prepare("UPDATE usuario SET paswusu = ? WHERE emailusu = ?");
        $stmt->execute([$hashed_password, $emailusu]);

        $stmt = $pdo->prepare("DELETE FROM token WHERE token = ?");
        $stmt->execute([$token]);

        echo "<script>alert('Contraseña actualizada con éxito.'); window.location.href='../index.php?pg=1002';</script>";
    } else {
        echo "<script>alert('El token no es válido o ha expirado.'); window.location.href='../index.php?pg=1002';</script>";
    }
}
?>
