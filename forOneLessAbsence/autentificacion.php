<?php
include("conexion.php"); 
session_start();

if (!isset($_SESSION['clave'])) {
    $_SESSION['clave'] = generarClave();
    $_SESSION['ultimo_cambio'] = time();  
}

$tiempo_transcurrido = time() - $_SESSION['ultimo_cambio'];

if ($tiempo_transcurrido >= 30) {
  $nuevaClave = generarClave();
  $_SESSION['clave'] = $nuevaClave;
  $sqlU = "
  UPDATE autentificacion 
  SET clave = ? 
  WHERE id_autentificacion = 1
  ";
  $stmtU = $link->prepare($sqlU);
  $stmtU->bind_param("i", $nuevaClave);
  $stmtU->execute();
  $_SESSION['ultimo_cambio'] = time();  
}

function generarClave() {
    return str_pad(rand(0, 999999), 6, "0", STR_PAD_LEFT);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $stmt = $link->prepare("SELECT clave FROM autentificacion LIMIT 1");
  $stmt->execute();
  $result = $stmt->get_result();

  $stmtI = $link->prepare("SELECT * FROM ingresar WHERE id_empleados = ? and fecha = CURDATE()");
  $stmtI->bind_param('i', $_SESSION['user_id']);
  $stmtI->execute();
  $resultI = $stmtI->get_result();

  if ($resultI->num_rows < 0) {
      while ($row = $result->fetch_assoc()) {
        if ($_POST['clave'] == $row['clave']) {
            $sqlIngreso = "INSERT INTO ingresar (id_empleados, id_sucursal, ingreso_egreso, fecha, hora) VALUES (?, ?, 1, CURDATE(), CURTIME())";
            $stmtIngreso = $link->prepare($sqlIngreso);
            $stmtIngreso->bind_param("ss", $_SESSION['user_id'], $_SESSION['user_sucursal']);
            $stmtIngreso->execute();
        } else {
            $error = 'Clave de autentificación errónea';
        }
      }
  }else{
    $error = 'Ya se te a tomado asistencia el dia de hoy';
  }

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="navb">
        <ul class="nav">
            <li class="nav-item nav-title">
            <a class="nav-link active" aria-current="page" href="./index.php">For one Less Absence</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./index.php">Asistencia</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./personal.php">Personal</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./autentificacion.php">Autentificación</a>
            </li>

            <!-- Cuenta -->

            <li class="nav-item nav-profile">
            <a class="nav-link" href="./register.php">Cerrar Sesión</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
            </li>
        </ul>
    </div>

    <div class="card">
        <?php 
            if ($_SESSION['user_role'] == 'Gerente' or $_SESSION['user_role'] == 'Administrador'){
                $stmt = $link->prepare("SELECT clave FROM autentificacion LIMIT 1");
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<h2>Clave: " . htmlspecialchars($row['clave']) . " Tiempo Restante: ". (30 - $tiempo_transcurrido) ."</h2>";
                    }
                }
            }
        ?>
        <form action="" method="post">
            <div class="item-form">
                <label for="clave" class="form-label">Clave</label>
                <input type="text" class="form-control" id="clave" name="clave" maxlength="6" required>
            </div>
            <br/>
            <button type="submit" class="btn btn-primary">Enviar</button>
            <?php 
                if(isset($error)){
                    echo '<div class="alert alert-warning" role="alert">';
                    echo   $error;
                    echo '</div>';
                }
            ?>
        </form>
    </div>

</body>

<!-- Style de prueba -->

<style>

  .navb{
    position:absolute;
    top: 0; 
    width: 186.2vh;
  }

  body{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .bodyTable{
    padding: 50px !important;
  }

  .barraTr{
    height: 100%;
    width: 10px;
    background-color: #ECF238;
  }

  .nav{
    border-bottom: 1px black solid;
    height: 8svh;
    align-items: center !important;
    color: white; 
    --bs-nav-link-color: white !important;
    --bs-nav-link-hover-color: #E688F2 !important;
    background-color: black;
  }

  .nav-profile{
    align-items: center !important;
    display: flex;
    flex-direction: right;
  }

  .nav-item:hover{
    transform: scale(1.1);
  }

  .nav-title{
    font-size: 25px;
  }

  .Tarde{
    background-color: #ECF238 !important;
  }

  .Ausente{
    background-color: red !important;
  }

  .Presente{
    background-color: #55D983 !important;
  }

  .form-date{
    border-bottom: 1px black solid;
    margin: 2svh;
    padding: 2svh 0;
  }

  .card{
    width: 100svh;
    padding: 5svh;
  }

</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
</html>