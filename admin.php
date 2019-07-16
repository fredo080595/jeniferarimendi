<?php 
session_start();

if(isset($_SESSION['user'])){

 ?>

 <?php require "controles/funciones.php"; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" >

    <title>Admin</title>
  </head>
  <body>

    <nav class="navbar navbar-light bg-light justify-content-end">
       <a class="navbar-brand text-danger" href="controles/salir.php">salir</a>
    </nav>
   
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">agregar imagen</button>
          <table class="table">
            <thead>

              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre de la imagen</th>
                <th scope="col">eliminar</th>
              </tr>

            </thead>
            <tbody>

              <?php
              $datos = visulizarDatos(); 
              foreach ($datos as $value): ?>
              <tr>
                <th scope="row"><?php echo $value['f_id'] ?></th>
                <td><?php echo $value['f_nombre_foto'] ?></td>
                <td><a href="#" onclick="eliminar('<?php echo $value['f_id'] ?>')">eliminar</a></td>
        
              </tr>                 
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <form id="formGaleria" enctype="multipart/form-data">                
              <div class="form-row">
                <div class="form-group col-sm-12">
                  <label for="exampleFormControlFile1">Example file input</label>
                  <input type="file" class="form-control-file" id="exampleFormControlFile1" name="foto-img[]" multiple="multiple">
                </div> 
              </div>
              </form>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardarCambios">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js" ></script>
  </body>
</html>


<script>
    $(document).ready(function() {
            $('#guardarCambios').on('click', function(e) {
              
                e.preventDefault();

                let datos = new FormData($('#formGaleria')[0]);

             $.ajax({
                  url: 'controles/agregar_foto.php',
                  type: 'POST',
                  data: datos,
                  dataType: "json",
                  contentType:false,
                  processData:false,
                  cache:false,
                  success: function(r){
                    if (r == 1) {
                        alert('Agregado con exito');
                        location.reload();
                    }else{
                        alert('Error al agregar');
                        location.reload();
                    }
                  }
                });

            });

    });



    function eliminar(id){

      $.ajax({
        url: 'controles/eliminar.php',
        type: 'POST',
        data: 'id='+id,
        success:function(r){
          if (r == 1) {
            alert('eliminado con exito');
            location.reload();
          }else{
            alert('error al eliminar');
            location.reload();
          }
        }


      });


    }


</script>

<?php
} else {
  header("location:login.php");
  }
 ?>