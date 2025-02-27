<?php
class Conexion {
    private static $pdo = null;

    public static function get_conexion() {
        if (self::$pdo === null) { // Solo se crea una vez
            include __DIR__ . "/datos.php";
            try {
                self::$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>
