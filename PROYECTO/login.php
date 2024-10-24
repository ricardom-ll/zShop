<?php 
session_start();

    if  (isset($_POST['aceptar'])){
        //Validamos y filtramos los datos de inicio de sesion
        $login=htmlspecialchars(trim(filter_input(INPUT_POST,'login')));
        if ($login==""){
            $errores['login']="Debes introducir un usuario";
        }
        $pass=htmlspecialchars(trim(filter_input(INPUT_POST,'password')));
        if ($pass==""){
            $errores['pass']="Debes introducir la contraseña";
        }
        //Incluímos el fichero de configuración
        include 'config.php';

        
        try {
            //1.- Establezco la conexión a la BBDD
            $con=new PDO($dsn,$usuario,$contrasena);

            //2.- Monto la sentencia SQL que quiero lanzar de manera parametrizada
            $sql="SELECT nombre, password from usuarios where login = :login and password = :password";

            //3.- Preparo la sentencia con el método prepare() de la conexión establecida
            $stmt=$con->prepare($sql);

            //4.- Lanzo la sentencia contra la BBDD
            if  ($stmt->execute([":login"=>$login, ":password"=>sha1($pass)])){ //SELECT nombre from usuarios where login='ricardo' and password='francis8';
                if  ($fila=$stmt->fetch()){ //fetch(): avanza una posición en las filas que devuelve  el execute y devuelve los datos de la fila en un array asociativo donde la clave es el nombre de la columna y el valor, el valor de la columna
                        $_SESSION['identificado']=$fila['nombre'];
                        header("location:administrador.php");
                        die();    
                } else{
                    $error="Error de identificación";
                }
            }else {
                $error="Error de identificación";
            }


        } catch (PDOException $e){
            die("Fallo en la conexión: ".$e->getMessage());
        }  catch(Exception $e){
            die("Error: ".$e->getMessage());
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
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #1a1a1a;
      color: #fff;
    }

    form {
      border: 1px solid #333;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
      background-color: #333;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #fff;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
      background-color: #444;
      color: #fff;
      border: 1px solid #555;
      border-radius: 4px;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
  <title>Inicio de Sesión</title>
</head>
<body>

  <form action="" method="post">
    <label for="login">Usuario:</label>
    <input type="text" id="login" name="login" value="<?=isset($login) && isset($errores) ? $login : ''?>" />
    <?=isset($errores['login']) ? "<span style='color:red'>{$errores['login']}</span>" : ''?><br><br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" value="<?=isset($pass) && isset($errores) ? $pass : ''?>" />
    <?=isset($errores['pass']) ? "<span style='color:red'>{$errores['pass']}</span>" : ''?><br><br>

    <button type="submit" name="aceptar">Iniciar Sesión</button>
    <?=isset($error) ? "<span style='color:red'>{$error}</span>" : ''?>
  </form>

</body>
</html>