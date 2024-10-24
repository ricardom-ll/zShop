<?php
//Iniciamos sesion
session_start();
//No permitimos entrar en la pagina si no se esta identificado    
if (!isset($_SESSION['identificado'])){
    header ('location: index.php');
    die();
}
//Incluimos el fichero de configuracion
include 'config.php';
//Establecemos conexion con la base de datos
try{
	$con = new PDO($dsn,$usuario,$contrasena);
} catch (PDOException $e){

}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap">
  <style>
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #1a1a1a;
      color: #fff;
    }

    header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      padding: 20px;
      background-color: #333;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
    }

    header img {
      border-radius: 50%;
      margin-right: 20px;
    }

    a {
      display: inline-block;
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    a:hover {
      background-color: #45a049;
    }

    section {
      width: 80%;
      margin-top: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #555;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #333;
      color: #fff;
    }

  </style>
  <title>Administrador</title>
</head>
<body>

  <header>
    <div>
        <?php
        try{
            //Montamos la consulta para mostra el usuario y la foto
            $sql="SELECT nombre, imagen from usuarios";
            $stmt=$con->prepare($sql);
            if	($stmt->execute()){
                while	($fila=$stmt->fetch()){
                    echo "<img src='".$fila['imagen']."' width='60px' height='70px' />";	
                    echo $fila['nombre'];
                }	
            }
            } catch (PDOException $e){
                die ("Error al mostrar datos");
            } catch (Exception $e){
                die ("Error de acceso");
            }
        ?>   
    </div>
    <a href="salir.php">SALIR</a>
  </header>

  <section>
    <table>
      <thead>
        <tr>
          <th>Administración</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Mantenimiento de categorías</td>
          <td><a href="categorias.php">ADMINISTRAR</a></td>
        </tr>
        <tr>
          <td>Mantenimiento de productos</td>
          <td><a href="productos.php">ADMINISTRAR</a></td>
        </tr>
        <tr>
          <td>Mantenimiento de slides</td>
          <td><a href="slides.php">ADMINISTRAR</a></td>
        </tr>
        <tr>
          <td>Mantenimiento de indefinido</td>
          <td><a href="indefinido.php">ADMINISTRAR</a></td>
        </tr>

      </tbody>
    </table>
  </section>
</body>
</html>