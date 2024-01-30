<?php

class Conexion
{
    protected $host;
    protected $db;
    protected $user;
    protected $pass;
    protected $dsn;
    protected $conexion;

    public function __construct()
    {
        $this->host = "localhost";
        $this->db = "GestionTareas";
        $this->user = "root";
        $this->pass = "";
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
        $this->crearConexion();
    }

    public function crearConexion()
    {
        try {
            $this->conexion = new PDO($this->dsn, $this->user, $this->pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Mostramos un mensaje si la conexión fue exitosa (esto es opcional)
            echo "Conexión a la base de datos exitosa desde Conexion.php<br>";
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage());
        }
    }

    // Método para obtener la conexión desde fuera de la clase
    public function getConexion()
    {
        return $this->conexion;
    }
}
?>
