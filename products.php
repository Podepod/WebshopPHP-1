<?php
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Galactic Empire Sith Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel='icon' href='GESS.ico' type='image/x-icon'/>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="styles/product.css" rel="stylesheet">
    <script>
      $(document).ready(function(){
        $("#lightsabers").click(function(){
          $("#products").load("includes/load_products.php", {
            loadProduct: "Lightsabers"
          });
        });
      });
    </script>
  </head>
  <body>
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand text-light" style="text-align:center;">Galactic Empire Sith Shop</h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link" href="index.php">Home</a>
        <a class="nav-link active" href="products.php">Producten</a>
        <?php
          if(isset($_SESSION["CustomerID"]))
          {
            echo('<a class="nav-link" href="checkout.php">Mandje</a>');
            if($_SESSION["Admin"] == 1)
            {
              echo('<a class="nav-link" href="dashboard.php">Dashboard</a>');
            }
            echo('<a class="nav-link" href="includes/sign_out.php">Logout</a>');
          }
          else
          {
            echo('<a class="nav-link" href="sign_in_page.php">Login</a>');
          }
        ?>
      </nav>
    </div>
  </header>

<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center">
  <div class="col-md-5 p-lg-5 mx-auto my-5">
    <h1 class="display-4 font-weight-normal text-light">Ons aanbod</h1>
  </div>
</div>
<button id="lightsabers" type="submit" class="btn btn-primary">Only lightsabers</button>
<button id="all" type="submit" class="btn btn-primary">Everything</button>
<div id="products">
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
