<?php
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Signin</title>
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
    <link href="styles/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
  <div class="container">
    <div class="row">
    <form class="form-signin" action="includes/sign_in.php" method="POST">
      <img class="mb-4" src="images/GESS_logo_light.png" alt="" width="144" height="108">
      <h1 class="h3 mb-3 font-weight-normal text-light">Sign in here</h1>
      <label for="email" class="sr-only text-light">Email address</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
      <button class="btn btn-outline-light btn-lg" type="submit" id="signin" name="signin">Log in</button>
    </form>
    </div>
    <div class="row">
      <div class="d-flex justify-content-center"> 
        <a href="sign_up_page.php" class="btn btn-primary stretched-link">Registreer je hier</a>
      </div>
    </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>
