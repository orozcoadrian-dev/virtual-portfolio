<?php

/**
 * Clase Conexion
 * 
 * Gestiona la conexión a la base de datos MySQL utilizando PDO.
 */
class Conexion {
    // Credenciales predefinidas de la base de datos
    private static $host = "localhost";
    private static $dbname = "db_virtual_portfolio";
    private static $usuario = "root";
    private static $contrasena = "";
    private static $charset = "utf8mb4";

    /**
     * Establece la conexión con la base de datos MySQL.
     * 
     * @return PDO Instancia de la conexión PDO.
     */
    public static function conectar() {
        try {
            // Construcción del Data Source Name (DSN)
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=" . self::$charset;
            
            // Opciones de configuración de PDO
            $opciones = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en caso de errores
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna los datos como array asociativo
                PDO::ATTR_EMULATE_PREPARES   => false,                  // Desactiva la emulación de sentencias preparadas para mayor seguridad
            ];

            // Crear y retornar la instancia de PDO
            $pdo = new PDO($dsn, self::$usuario, self::$contrasena, $opciones);
            return $pdo;
            
        } catch (PDOException $e) {
            // Registrar el error en el log del servidor
            error_log("Error de conexión a la base de datos: " . $e->getMessage());
            
            // Mensaje genérico para el usuario
            die("Error de conexión: No se pudo conectar a la base de datos. Verifica tus credenciales.");
        }
    }
}
