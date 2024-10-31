<?php
    require_once('conexion.php');
    
    // Obtener datos del formulario
    $usu = isset($_POST['usu']) ? $_POST['usu'] : NULL;
    $pas = isset($_POST['pss']) ? $_POST['pss'] : NULL;
    
    if($usu && $pas) {
        valida($usu, $pas);
    } else {
        red();
    }

    function valida($usu, $pas) {
        $res = ingr($usu, $pas);
        $res = isset($res) ? $res : NULL;
        
        if($res) {
            session_start();
            $_SESSION['idusu'] = $res[0]['idusu'];
            $_SESSION['nomusu'] = $res[0]['nomusu'];
            $_SESSION['apeusu'] = $res[0]['apeusu'];
            $_SESSION['idper'] = $res[0]['idper'];
            $_SESSION['nomper'] = $res[0]['nomper'];
            $_SESSION['aut'] = '1011322322#2006';  // Llave de autenticación
            echo "<script>window.location='../home.php?';</script>";
        } else {
            red();
        }
    }

    function red() {
        echo "<script>window.location='../index.php?err=oK';</script>";
    }

    function ingr($usu, $pas) {
        $res = NULL;
        $pas = sha1(md5($pas.'Jd#')); // Encriptación de la contraseña
        // Consulta SQL adaptada a la estructura de la base de datos
        $sql = "SELECT u.idusu, u.nomusu, u.apeusu, u.emailusu, u.idper, p.nomper 
                FROM usuario AS u 
                INNER JOIN perfil AS p ON u.idper = p.idper 
                WHERE u.emailusu = :emailusu AND u.paswusu = :paswusu";
        
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        
        // Vinculación de parámetros
        $result->bindParam(":emailusu", $usu);
        $result->bindParam(":paswusu", $pas);
        $result->execute();
        
        // Obtener resultados
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
?>