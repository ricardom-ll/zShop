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
    if  (isset($_POST['aceptar'])){
        //Validamos y filtramos los datos nuevos
        $nombre=htmlspecialchars(trim(filter_input(INPUT_POST,'nombre')));
        if ($nombre==""){
            $errores['nombre']="Debes introducir un nombre";
        }
        $categoria=htmlspecialchars(trim(filter_input(INPUT_POST,'categoria',FILTER_VALIDATE_INT)));
        $precio=htmlspecialchars(trim(filter_input(INPUT_POST,'precio',FILTER_VALIDATE_FLOAT)));
        if ($precio==""){
            $errores['precio']="Debes introducir un precio";
        }
        $texto=htmlspecialchars(trim(filter_input(INPUT_POST,'texto')));
        if ($texto==""){
            $errores['texto']="Debes introducir un texto";
        }
        $fecha= new DateTime();
        $fechaSQL= $fecha->format('Y-m-d');
        if(!isset($errores)){
          try {
            $sql="INSERT INTO `productos` (`nombre`, `idcat`, `precio`, `detalle`, `fecalta`) VALUES ('$nombre', '$categoria', '$precio', '$texto', '$fechaSQL')";
            $stmt=$con->prepare($sql);
            if  ($stmt->execute()){
                if  ($stmt->rowCount()!=1){
                    $error="Se ha producido un error al actualizar la categoría";
                }
            }
          } catch (PDOException $e){
              die ("Error update".$e->getMessage());
            }
        }   
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

    a, .button {
      display: inline-block;
      margin-right: 10px;
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .button-red {
      background-color: #ff3333;
    }

    a:hover, .button:hover {
      background-color: #45a049;
    }

    .button-red:hover {
      background-color: #B61010;
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

    form {
      border: 1px solid #333;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
      background-color: #333;
      width: 300px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #fff;
    }

    input[type="text"],
    input[type="file"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
      background-color: #444;
      color: #fff;
      border: 1px solid #555;
      border-radius: 4px;
    }

    textarea {
      width: 100%;
      height: 160px;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
      background-color: #444;
      color: #fff;
      border: 1px solid #555;
      border-radius: 4px;
    }

    select {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
      background-color: #444;
      color: #fff;
      border: 1px solid #555;
      border-radius: 4px;
    }

    input[type="file"] {
      cursor: pointer;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

  </style>
  <title>Nuevo producto</title>
</head>
<body>

  <header>
    <div>
        <?php
        try{
            //Montamos la consulta para mostrar el nombre y foto del usuario
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
    <form method="post" enctype="multipart/form-data">
        Categoria de producto: 
        <select id="categoria" name="categoria">
        <?php 
          try {
            //Montamos la consulta para mostrar las categorias que tenemos 
            $sql="Select nombre, id from categorias";
            $stmt=$con->prepare($sql);
            if  ($stmt->execute()){
              while ($fila=$stmt->fetch()){
        ?>
                    <option value="<?=$fila['id']?>"><?=$fila['nombre']?></option>      
        <?php
              }

            }
            } catch (PDOException $e){
              echo $stmt->debugDumpParams();
              die("Error de conexión".$e->getMessage());
            }
        ?>
        </select><br><br>
        Nombre de producto: <input type="text" name="nombre" value="<?=isset($nombre) && isset($errores) ? $nombre : ''?>"  /><br/>
        <?=isset($errores['nombre']) ? "<span style='color:red'>{$errores['nombre']}</span>" : ''?><br>
        Descripción de producto: <br><textarea name="texto" height="161px" width="300px"  ></textarea><br>
        <?=isset($errores['texto']) ? "<span style='color:red'>{$errores['texto']}</span>" : ''?><br>
        Precio de producto: <input type="text" name="precio" value="<?=isset($precio) && isset($errores) ? $precio : ''?>" /><br/>
        <?=isset($errores['precio']) ? "<span style='color:red'>{$errores['precio']}</span>" : ''?><br>
        <input type="submit"  name="aceptar" value="Aceptar"/>
    </form>
        <?=isset($error) ? "<span style='color:red'>{$error}</span>" : ''?>
    <br>
    <a href="productos.php">VOLVER ATRAS</a>
  </section>
</body>
</html>