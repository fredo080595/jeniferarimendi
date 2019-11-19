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
        <a class="navbar-brand text-danger" href="galeria.php">Galería</a>
       <a class="navbar-brand text-danger" href="controles/salir.php">Salir</a>
    </nav>
   
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">agregar imagen</button>
          <button class="btn btn-danger" id="eliminar-todo">Eliminar todas las fotos</button>
          <table class="table">
            <thead>

              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre de la imagen</th>
                <th scope="col">Id de la Galeria</th>
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
                <td><a target="_blank" href="galeria-cliente.php?id_geleria=<?php echo $value['id_nombre_galeria'] ?>"><?php echo $value['id_nombre_galeria'] ?></a></td>
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
    <script src="js/blockUI.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js" ></script>
  </body>
</html>


<script>
    $(document).ready(function() {
            $('#guardarCambios').on('click', function(e) {
              
                e.preventDefault();

                $('#exampleModal').modal('hide');

                bloquearPantalla('cargando fotos');



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
                        location.reload();
                        desbloquearPantalla();
                    }else{
                        location.reload();
                        desbloquearPantalla();
                    }
                  }
                });

            });

    });



    $('#eliminar-todo').on('click',  function(event) {
      event.preventDefault();
      /* Act on the event */



      var confirmar = confirm('Esta seguro que desea eliminar todas las fotos');
      if (confirmar) { 
        $.ajax({
          url: 'controles/eliminar_todo.php',
          type: 'POST',
          dataType: 'json',
          data: {param: 1},
          success:function(r){

            if (r == 1) {
                alert('se eliminaron todos los archivos con exito');
                location.reload();
            }

          }
        });
      }


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



    function bloquearPantalla(texto){

            $.blockUI({
              message:  (texto == null) ? '' : '<h4 class="text-dark">'+texto+'</h4>'+
            '<img src="img/fluid-loader.gif" alt="cargando"  width = "200px"/>',
             css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#f2f4f5', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 

                color: '#fff' 
            } }); 
    }

    function desbloquearPantalla(){
      setTimeout($.unblockUI, 10);
    }


</script>

<?php
} else {
  header("location:login.php");
  }
 ?>