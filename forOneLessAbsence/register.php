<?php
  include("conexion.php");
  session_start();
  session_destroy();
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $rol = $_POST['rol'];
    $area = $_POST['area'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['DNI'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $codeempre = $_POST['codempre'];

    if (empty($email) || empty($rol) || empty($area) || empty($nombre) || empty($apellido) || empty($dni) || empty($password) || empty($confirmPassword) || empty($codeempre)) {
      $error = "Todos los datos son necesarios.";
    } elseif ($password !== $confirmPassword) {
      $error = "Las contraseñas no son iguales.";
    } else {
      $sql = "SELECT * FROM sucursal WHERE id_sucursal = ?";
      $stmt = $link->prepare($sql);
      $stmt->bind_param("s", $codeempre);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows === 0) {
        $error = "El código de empresa no es válido.";
        exit();
      }

      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      $sqlUsuario = "INSERT INTO usuarios (id_sucursal, nombre, email, rango, contrasena) VALUES (?, ?, ?, ?, ?)";
      $stmtUsuario = $link->prepare($sqlUsuario);
      $stmtUsuario->bind_param("sssss", $codeempre, $nombre, $email, $rol, $hashedPassword);

      if ($stmtUsuario->execute()) {
        $userId = $stmtUsuario->insert_id;

        $sqlEmpleado = "INSERT INTO empleados (id_sucursal, nombre, apellido, area, dni, rol) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtEmpleado = $link->prepare($sqlEmpleado);
        $stmtEmpleado->bind_param("ssssss", $codeempre, $nombre, $apellido, $area, $dni, $rol);

        if ($stmtEmpleado->execute()) {
          $_SESSION['success'] = "Registro exitoso!";
          header("Location: http://localhost/forOneLessAbsence/login.php");
          exit();
        } else {
          $error = "Error al registrar el empleado. Por favor, intente nuevamente.";
        }

      } else {
        $error = "Error durante el registro del usuario. Por favor, intente nuevamente.";
      }
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="estiloRegistro.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="card">
      <div class="lados">
        <div class="ladoi">
          <img class="imagen" crossorigin="anonymous" src="https://media-public.canva.com/XuwMY/MAEqogXuwMY/1/tl.png" alt="data gradient icon" draggable="false">
        </div>
        <div class="ladod">
          <form action="" method="post">
            <div class='item-form'>  
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email">
            </div>
            <div class='item-form'>
              <label for="rol" class="form-label">Rol</label>
              <input type="text" class="form-control" id="rol">
            </div>
            <div class='item-form'>
              <label for="area" class="form-label">Area</label>
              <input type="text" class="form-control" id="area">
            </div>
            <div class='item-form'>
              <label for="DNI" class="form-label">DNI</label>
              <input type="int" class="form-control" id="DNI">
            </div>
            <div class='item-form'>
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password">
            </div>
            <div class='item-form'>
              <label for="confirmPassword" class="form-label">Confirme Contraseña</label>
              <input type="password" class="form-control" id="confirmPassword">
            </div>
            <div class='item-form'>
              <label for="codeempre" class="form-label">Codeempre</label>
              <input type="text" class="form-control" id="codeempre">
            </div>
            <a href="http://localhost/forOneLessAbsence/login.php" class="vinculo">¿Ya tienes una cuenta?</a>
            <button type="submit" class="btn btn-light">Registrarse</button>
          </form>
        </div>
      </div>
    </div>
</body>

<style>

  body{
    display:flex;
    justify-content: center;
    align-items: center;
    padding: 10svh;
  }

  .lados{
    display:flex;
  }

  .ladoi{
    display:flex;
    justify-content: center;
    align-items: center;
    width: 50%;
  }

  .ladod{
    display:flex;
    justify-content: center;
    width: 50%;
  }

  .card{
    width: 150svh;
    background-color: #0c0c0d;
    padding: 5svh 4svh;
  }

  form{
    display:flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 2svh;
    color: white;
  }

  .form-control {
    width: 60svh !important;
  }

  .imagen{
    width: 40svh;
  }


</style>
<!-- <link rel="stylesheet" href="./assets/css/register/style.css"> -->
</html>