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
    <link rel="stylesheet" href="styles/checkout.css">
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
    <link href="styles/form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <header class="masthead mb-auto">
      <div class="inner">
        <h3 class="masthead-brand text-light" style="text-align:center;">Galactic Empire Sith Shop</h3>
        <nav class="nav nav-masthead justify-content-center">
          <a class="nav-link" href="index.php">Home</a>
          <a class="nav-link" href="products.php">Producten</a>
          <?php if(isset($_SESSION["CustomerID"]))
            {
              echo('<a class="nav-link" href="includes/sign_out.php">Logout</a>');
            }
            else
            {
              echo('<a class="nav-link" href="sign_in.php">Login</a>');
            }
          ?>
        </nav>
      </div>
    </header>

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="images/GESS_logo_light.png" alt="logo" width="144" height="108">
        <h1>Registreren</h1>
        <h4>Registreer je hier:</h4>
      </div>
    </div>
    <div class="container" style="max-width:80%;">
      <form action="includes/sign_up.php" method="POST">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName" class="label-light">Voornaam</label>
            <input type="text" class="form-control" name="firstname" id="firstName" placeholder="voornaam" value="" required>
            <div class="invalid-feedback">
              Je voornaam is een verplicht veld.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName" class="label-light">Achternaam</label>
            <input type="text" class="form-control" name="lastname" id="lastName" placeholder="achternaam" value="" required>
            <div class="invalid-feedback">
              Je achternaam is een verplicht veld.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email" class="label-light">e-mailadres</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required>
            <div class="invalid-feedback" style="width: 100%;">
              Je e-mailadres is een verplicht veld.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="birthdate" class="label-light">Geboortedatum</label>
          <input type="date" class="form-control" name="birthdate" id="birthdate" required>
          <div class="invalid-feedback">
            Geef a.u.b. je geboortedatum in.
          </div>
        </div>

        <div class="mb-3">
          <label for="address" class="label-light">Adres</label>
          <input type="text" class="form-control" name="address" id="address" placeholder="Straat + nr" required>
          <div class="invalid-feedback">
            Geef a.u.b. je adres in.
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country" class="label-light">Land</label>
            <select class="custom-select d-block w-100" id="country" name="country" required>
              <option value="">Kies...</option>
              <option>België</option>
            </select>
            <div class="invalid-feedback">
              Geef a.u.b. een bestaand land in.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="postcode" class="label-light">Postcode</label>
            <input type="text" class="form-control" id="postcode" name="postcode" placeholder="" required>
            <div class="invalid-feedback">
              Je postcode is een verplicht veld.
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-5 mb-3">
              <label for="password" class="label-light">Wachtwoord</label>
              <input type="password" id="password" name="password" required>
            </div>
            <div class="col-md-3 mb-3">
              <label for="passwordConfirm" class="label-light">Bevestig wachtwoord</label>
              <input type="password" id="passwordConfirm" name="passwordConfirm" required>  
            </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit" id="signup-submit" name="signup-submit">Registreren</button>
      </form>
    </div>
  </div>
  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1" style="color: #ebebeb;">&copy; The Galactic Sith Shop 2020</p>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
