<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Registro</title>
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-4 offset-md-4">
          <br>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Registro al Sistema</h5>
              <br>
              <form method="post" action="<?php echo site_url("login/nuevo"); ?>">
                <div class="form-group">
                  <label for="usuario">Usuario</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label for="password">Clave</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                  <label for="repetir_pass">Repetir Clave</label>
                  <input type="password" class="form-control" id="repetir_pass" name="repetir_pass">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Crear Usuario</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>    

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  </body>
</html>