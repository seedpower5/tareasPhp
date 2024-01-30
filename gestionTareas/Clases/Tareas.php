<?php
//clase tareas
class Tareas
{
    private $id;
    private $nombre;
    private $descripcion;
    private $fechaCreacion;
    private $completado;
//constructor de la clase
    public function __construct($id, $nombre, $descripcion, $fechaCreacion, $completado)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->fechaCreacion = $fechaCreacion;
        $this->completado = $completado;
    }

    // Getters y setters 

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    public function getCompletado()
    {
        return $this->completado;
    }

    // Método para visualizar todas las tareas
    public static function visualizarTareas($conexion)
    {
        $query = "SELECT * FROM Tareas";
        $stmt = $conexion->prepare($query);
        $stmt->execute();

        $tareasData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tareas = [];

        foreach ($tareasData as $tareaData) {
            $tareas[] = new Tareas(
                $tareaData['id'],
                $tareaData['nombre'],
                $tareaData['descripcion'],
                $tareaData['fechaCreacion'],
                $tareaData['completado']
            );
        }

        return $tareas;
    }
    //metodo para borrar una tarea
     
      public static function borrarTarea($conexion, $id)
      {
          $query = "DELETE FROM Tareas WHERE id = :id";
          $stmt = $conexion->prepare($query);
          $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  
          return $stmt->execute();
      }
   // Método para añadir una nueva tarea
   public static function añadirTarea($conexion, $nombre, $descripcion, $fechaCreacion, $completado)
   {
       $query = "INSERT INTO Tareas (nombre, descripcion, fechaCreacion, completado) 
                 VALUES (:nombre, :descripcion, :fechaCreacion, :completado)";
       
       $stmt = $conexion->prepare($query);
       $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
       $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
       $stmt->bindParam(':fechaCreacion', $fechaCreacion, PDO::PARAM_STR);
       $stmt->bindParam(':completado', $completado, PDO::PARAM_BOOL);

       return $stmt->execute();
   }
    // Método para completar una tarea por ID
    public static function completarTarea($conexion, $id)
    {
        $query = "UPDATE Tareas SET completado = true WHERE id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    
}
?>
