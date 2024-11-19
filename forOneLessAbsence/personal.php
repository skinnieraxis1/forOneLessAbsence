<?php
  include("conexion.php");
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla presentismo</title>
</head>
<body>

  <!-- Navbar -->

  <div>
    <ul class="nav">
        <li class="nav-item nav-title">
          <a class="nav-link active" aria-current="page" href="./index.php">For one Less Abscence</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./index.php">Asistencia</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./personal.php">Personal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./autentificacion.php">Autentificacion</a>
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
    

  <div class="bodyTable">
    <table class="table">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Sucursal</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Área</th>
        <th scope="col">DNI</th>
        <th scope="col">Rol</th>
      </tr>
    </thead>
    <tbody>
    <?php
    // Consultar todos los empleados con la sucursal y sus detalles
    $queryEmpleados = "
    SELECT e.id_empleados, e.nombre, e.apellido, e.area, e.dni, e.rol, s.nombre AS sucursal, e.id_sucursal
    FROM empleados AS e
    INNER JOIN sucursal AS s ON e.id_sucursal = s.id_sucursal
    ";

    $stmt = $link->prepare($queryEmpleados);
    $stmt->execute();
    $resultEmpleados = $stmt->get_result();

    if ($resultEmpleados) {
        if ($resultEmpleados->num_rows > 0) {
            while ($arrayEmpleados = $resultEmpleados->fetch_assoc()) {
              
                echo "<tr>";
                echo "<td class='barraTr " . htmlspecialchars($arrayEmpleados['id_sucursal']) . "'></td>";
                echo "<td>" . htmlspecialchars($arrayEmpleados['sucursal']) . "</td>";
                echo "<td>" . htmlspecialchars($arrayEmpleados['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($arrayEmpleados['apellido']) . "</td>";
                echo "<td>" . htmlspecialchars($arrayEmpleados['area']) . "</td>";
                echo "<td>" . htmlspecialchars($arrayEmpleados['dni']) . "</td>";
                echo "<td>" . htmlspecialchars($arrayEmpleados['rol']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No se encontraron empleados.</td></tr>";
        }
    } else {
        echo "Error en la consulta: " . htmlspecialchars($link->error);
    }

    $stmt->close();
    ?>

    </tbody>
  </table>
</div>

</body>

<!-- Style de prueba -->

<style>

  body{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
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

</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
</html>
