<?php
  session_start();
  if(!isset($_SESSION['CustomerID']))
  {
    header("Location: sign_in_page.php");
  }
?>
<!doctype html>
<html lang="nl">
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
    <link href="styles/cover.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand">Galactic Empire Sith Shop</h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="#">Home</a>
        <a class="nav-link" href="products.php">Producten</a>
        <?php
          if(isset($_SESSION["CustomerID"]))
          {
            echo('<a class="nav-link" href="includes/sign_out.php">Logout</a>');
            if($_SESSION["Admin"] == 1)
            {
              echo('<a class="nav-link" href="dashboard.php">Dashboard</a>');
            }
          }
          else
          {
            echo('<a class="nav-link" href="sign_in_page.php">Login</a>');
          }
        ?>
      </nav>
    </div>
  </header>
  <main role="main" class="inner cover">
   <h1>Bedankt voor uw bestelling</h1>
   <a href="index.php">Terug naar de hoofdpagina</a>
  </main>
  <?php
    unset($_SESSION['shopping-cart']);
  ?>
  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p>Volg ons op <a href="wookiebook.html">Wookiebook</a></p>
    </div>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
