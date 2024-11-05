<?php
require_once('conexion.php');

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
            // Redirige a la página inicial según el perfil
            echo "<script>window.location='../home.php?pg=$paginaInicial';</script>";
        } else {
            // En caso de no encontrar página inicial, redirige a una página de error o dashboard
            echo "<script>window.location='../home.php';</script>";
        }
        exit();
    } else {
        red();
    }
}

function red() {
    echo "<script>window.location='../index.php?err=oK';</script>";
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
?>