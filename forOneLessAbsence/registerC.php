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
    <form>
      <div class="card text-bg-dark mb-3" style="width: 850px; height: 500px; margin-right: 50px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img class="imegen" crossorigin="anonymous" src="https://media-public.canva.com/XuwMY/MAEqogXuwMY/1/tl.png" alt="data gradient icon" draggable="false">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">REGÍSTRATE</h5>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirme Contraseña</label>
                <input type="password" class="form-control" id="confirmPassword">
              </div>
              <div class="mb-3">
                <label for="Codeempre" class="form-label">Codeempre</label>
                <input type="text" class="form-control" id="Codeempre">
              </div>
              <a href="url" class="vinculo">¿Ya tienes una cuenta?</a>
              <button type="submit" class="btn btn-light"><a href="./index.php">Enviar</a></button>
            </div>
          </div>
        </div>
      </div>
    </form>
</body>
<link rel="stylesheet" href="./assets/css/register/style.css">
</html>