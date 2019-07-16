<?php 
session_start();

if(isset($_SESSION['user'])){

 
require "controles/funciones.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Jennifer Arizmendi | Fotografía</title>

  <!-- Font Awesome Icons -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="css/creative.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" id="inicio">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#portfolio">Galería</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>



  <!-- Masthead -->

 

  <section id="portfolio">
    <div class="container-fluid p-0">
      <div class="row no-gutters">



        <?php
        $datos = visulizarDatos(); 
        foreach ($datos as $value): ?>
        <div class="col-lg-4 col-sm-6">
          <a class="portfolio-box" href="img/portfolio/fullsize/<?php echo $value['f_ruta'] ?>" >
            <img class="img-fluid" src="img/portfolio/fullsize/<?php echo $value['f_ruta'] ?>" alt="" >
            <div class="portfolio-box-caption">
              <div class="project-category text-white-50">
                <?php echo $value['f_nombre_foto'] ?>
              </div>

            </div>
          </a>
        </div>
       <?php endforeach ?>


      </div>

    </div>
  </section>


  <!-- Footer -->
  <footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">Copyright Jennifer Arizmendi Fotografía &copy; 2019 | Desarollado por <a href="https://www.linkedin.com/in/alfredo-ruiz-hernandez-515317152/" target="_blank">Alfredo R.</a></div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/creative.min.js"></script>

  <script>
    $(document).ready(function() {
    
        $(document).bind('contextmenu', function(event) {
            return false;          
        });

        $('#inicio').on('click',  function(event) {
          event.preventDefault();
          
            window.location.href = "admin.php"
        });

    });
  </script>

</body>

</html>
<?php
} else {
  header("location:login.php");
  }
 ?>