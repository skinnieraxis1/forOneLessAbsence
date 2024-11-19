<?php
  include("conexion.php");
  session_start();

  if (isset($_POST['email']) and isset($_POST['password']) and isset($_POST['confirmPassword']) and isset($_POST['rol']) and isset($_POST['area']) and isset($_POST['codempre'])){

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
        <div class="lado i">
          <img class="imegen" crossorigin="anonymous" src="https://media-public.canva.com/XuwMY/MAEqogXuwMY/1/tl.png" alt="data gradient icon" draggable="false">
        </div>
        <div class="lado d">
          <form action="">
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
            <a href="url" class="vinculo">¿Ya tienes una cuenta?</a>
            <button type="submit" class="btn btn-light"><a href="./index.php">Enviar</a></button>
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
  }

  .lados{
    display:flex;
    justify-content: space-between;
  }

  .card{
    width: 100svh;
    background-color: black;
    padding: 5svh 4svh;
  }

  form{
    display:flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 2svh;
    color: white;
  }

</style>
<link rel="stylesheet" href="./assets/css/register/style.css">
</html>