<?php

require_once 'conexion.php'; // Asegúrate de tener una clase `conexion` que maneje la conexión a la base de datos.

class Mmenu {
    private $idpag;
    private $idper;

    // Métodos GET
    public function getIdpag() {
        return $this->idpag;
    }

    public function getIdper() {
        return $this->idper;
    }

    // Métodos SET con validaciones
    public function setIdpag($idpag) {
        if (is_numeric($idpag) && $idpag > 0) {
            $this->idpag = $idpag;
        } else {
            throw new InvalidArgumentException("El idpag debe ser un número positivo.");
        }
    }

    public function setIdper($idper) {
        if (is_numeric($idper) && $idper > 0) {
            $this->idper = $idper;
        } else {
            throw new InvalidArgumentException("El idper debe ser un número positivo.");
        }
    }

    // Obtiene el menú ordenado por `ordpag`
    public function getMenu() {
        try {
            $sql = "SELECT p.idpag, p.nompag, p.rutpag, p.ordpag, p.icopag, p.titupag
                    FROM pagina AS p
                    INNER JOIN perxpag AS f ON p.idpag = f.idpag
                    WHERE p.mospag = 1 AND f.idper = :idper
                    ORDER BY p.ordpag ASC;";

            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(':idper', $idper, PDO::PARAM_INT); // Asegurar tipo INT
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en getMenu: " . $e->getMessage());
            return []; // Retorna un array vacío en caso de error
        }
    }

    // Valida datos de una página específica
    public function getVal() {
        try {
            $sql = "SELECT p.idpag, p.nompag, p.rutpag, p.icopag, p.mospag, p.titupag
                    FROM pagina AS p
                    INNER JOIN perxpag AS g ON p.idpag = g.idpag
                    WHERE p.idpag = :idpag AND g.idper = :idper;";

            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $idpag = $this->getIdpag();
            $result->bindParam(':idper', $idper, PDO::PARAM_INT); // Asegurar tipo INT
            $result->bindParam(':idpag', $idpag, PDO::PARAM_INT); // Asegurar tipo INT
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en getVal: " . $e->getMessage());
            return []; // Retorna un array vacío en caso de error
        }
    }

    // Método para obtener el menú junto con la información de sesión activa
    public function getMenuWithSessionInfo() {
        try {
            // Obtiene el menú ordenado por `ordpag`
            $menuData = $this->getMenu();

            // Agrega datos adicionales desde la sesión activa
            $sessionInfo = [];
            if (isset($_SESSION['nomusu'], $_SESSION['apeusu'], $_SESSION['nomper'])) {
                $sessionInfo = [
                    'usuario' => $_SESSION['nomusu'] . ' ' . $_SESSION['apeusu'],
                    'perfil' => $_SESSION['nomper'],
                ];
            } else {
                $sessionInfo = ['error' => 'No hay sesión activa'];
            }

            // Devolvemos el menú junto con la información adicional
            return [
                'menu' => $menuData,
                'sessionInfo' => $sessionInfo,
            ];
        } catch (PDOException $e) {
            error_log("Error en getMenuWithSessionInfo: " . $e->getMessage());
            return [
                'menu' => [],
                'sessionInfo' => ['error' => 'Error al obtener el menú y la sesión'],
            ];
        }
    }
}
