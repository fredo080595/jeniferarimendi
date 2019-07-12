<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
,
    <title>Login</title>
  </head>
  <body>
    <div class="container">
      <div class="row align-content-center">
        <h1>
          Ingresar
        </h1>

        <div class="col-sm-7 m-5 p-5 offset-sm-5">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Usuario</label>
              <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="emailHelp" placeholder="Enter user">
 
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Contraseña</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary" id="btnacces">Submit</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<script>
  $(document).ready(function(){
    $('#btnacces').click(function(e){
      e.preventDefault();

      if($('#usuario').val()==""){
        alert("Debes agregar el usuario");
        return false;
      }else if($('#password').val()==""){
        alert('agregarpass');
        return false;
      }

      cadena="usuario=" + $('#usuario').val() + 
          "&password=" + $('#password').val();

          $.ajax({
            type:"POST",
            url:"controles/login.php",
            data:cadena,
            success:function(r){
              if(r==1){
                window.location="admin.php";
              }else{
                alert("Fallo al entrar :(");
              }
            }
          });
    }); 
  });
</script>