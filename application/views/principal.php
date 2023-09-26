<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>Todo App</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col">                
                <br>
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($_SESSION['OP'])) { 
                            $op= $_SESSION['OP'];
                            if ($op == 'OK'){
                        ?>
                            <div class="alert alert-success" role="alert">
                                Tarea creada exitosamente.
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-danger" role="alert">
                                El campo "Tarea" debe ser completado.
                            </div>
                            <br>
                        <?php } }?>
                        <form class="form-inline" method="post" action="<?php echo site_url("app/guardar"); ?>">
                            <input type="text" class="form-control mb-2 mr-sm-2" id="tarea" name="tarea" placeholder="Tarea">

                            <button type="submit" class="btn btn-primary mb-2"><i class="bi bi-plus-circle"></i></button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col">
                <br>
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach ($pendientes as $p) { ?>    
                                    <li class="list-group-item">
                                        <span id="texto-tarea">
                                            <?php echo $p["texto"]; ?>
                                        </span>                                        
                                        <span class="float-right">
                                            <a class="text-info" href="<?php echo site_url("app/borrar/".$p["id_tarea"]); ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a class="text-danger" href="<?php echo site_url("app/borrar/".$p["id_tarea"]); ?>">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>
                                    </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Bootbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

    <!-- Scrips -->
    <script>
        $(document).ready(function(){
            $('.alert').fadeOut(3000);


        });
    </script>

  </body>
</html>