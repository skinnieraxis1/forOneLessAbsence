<?php
  include("conexion.php"); 
  session_start();

  if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = $_POST['password'];

    $stmt = $link->prepare("
    SELECT * 
    FROM usuarios AS u
    INNER JOIN empleados AS e ON e.id_empleados = u.id_empleados
    INNER JOIN sucursal AS s ON s.id_sucursal = u.id_sucursal
    WHERE u.email = ?
    LIMIT 1;"
    );
    $stmt->bind_param("s", $email); 
    $stmt->execute(); 

    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
      $user = $result->fetch_assoc(); 
      if ($password == $user['contrasena']) {
        $_SESSION['user_id'] = $user['id_usuario'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_area'] = $user['area'];
        $_SESSION['user_role'] = $user['rol']; 
        $_SESSION['user_sucursal'] = $user['id_sucursal'];

        header("Location: index.php");
        exit();
      } else {
        $error = "Contraseña incorrecta.";
      }
    } else {
      $error = "No se encontró un usuario con ese correo electrónico.";
    }

    $stmt->close();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class='item-form'>
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <?php
              if (isset($error)) {
                echo "<div class='alert alert-danger' role='alert'>$error</div>";
              }
            ?>
            <a href="register.php" class="vinculo">¿Todavía no tienes una cuenta?</a>
            <button type="submit" class="btn btn-light">Iniciar Sesión</button>
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
    height: 100vh;
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
    padding: 10svh 4svh;
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
</html>
