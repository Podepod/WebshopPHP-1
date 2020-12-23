<?php
  session_start();
  if(isset($_POST["submit-add"]))
  {
    if(isset($_SESSION["shopping-cart"]))
    {
      $amountOfItems = count($_SESSION["shopping-cart"]);
      $itemInList = false;
      for ($i=0; $i < $amountOfItems; $i++)
      {
        if(($_SESSION["shopping-cart"][$i]["ProductID"] == $_POST["ProductID"]) && !$itemInList)
        {
          $_SESSION["shopping-cart"][$i]["Quantity"] += $_POST["Quantity"];
          $itemInList = true;
        }
      }
      if(!$itemInList)
      {
        $_SESSION["shopping-cart"][$amountOfItems] = array("ProductID" => $_POST["ProductID"], "Quantity" => $_POST['Quantity']);
      }
    }
    else
    {
      $_SESSION['shopping-cart'] = array(
        array("ProductID" => $_POST["ProductID"], "Quantity" => $_POST['Quantity'])
      );
    }
  }
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
              echo('<a class="nav-link" href="sign_in_page.php">Login</a>');
            }
          ?>
        </nav>
      </div>
    </header>

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="images/GESS_logo_light.png" alt="logo" width="144" height="108">
        <h1>Afrekening</h1>
        <h4>Hier is jouw bestelling:</h4>
      </div>

  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Jouw winkelkarretje</span>
      </h4>
      <ul class="list-group mb-3">
            <?php
              $sum = 0;
              foreach($_SESSION["shopping-cart"] as $item)
              {
                $sql = "SELECT name, price FROM Products WHERE ProductID = ". $item['ProductID'] . ";";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck > 0)
                {
                  $name = $row['name'];
                  $price = $row['price'];
                  echo('<li class="list-group-item d-flex justify-content-between lh-condensed"><div>');
                  echo(' <h6 class="my-0">' . $name . '</h6>');
                  echo('<small class="text-muted">' . $item['Quantity'] . '</small></div>');
                  echo('<span class="text-muted">€' . $price . '</span></li>');
                  $sum += $price * $item['Quantity'];
                }
                else
                {
                  header("Location: checkout.php?error=sqlerror1");
                }
              }
            ?>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total</span>
            <?php
              echo('<strong>€' . $sum . '</strong>');
            ?>
        </li>
      </ul>

    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Factuur adres</h4>
      <form action="betalen.php" method="POST">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName" class="label-light">Voornaam</label>
            <input type="text" class="form-control" id="firstName" placeholder="voornaam" value="" required>
            <div class="invalid-feedback">
              Je voornaam is een verplicht veld.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName" class="label-light">Achternaam</label>
            <input type="text" class="form-control" id="lastName" placeholder="achternaam" value="" required>
            <div class="invalid-feedback">
              Je achternaam is een verplicht veld.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="username" class="label-light">e-mailadres</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="email" class="form-control" id="username" placeholder="Email" required>
            <div class="invalid-feedback" style="width: 100%;">
              Je e-mailadres is een verplicht veld.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="address" class="label-light">Adres</label>
          <input type="text" class="form-control" id="address" placeholder="Staart + nr" required>
          <div class="invalid-feedback">
            Geef a.u.b. je adres in.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2" class="label-light">Adres 2 <span class="text-muted">(Optioneel)</span></label>
          <input type="text" class="form-control" id="address2" placeholder="Appartment of suite">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country" class="label-light">Land</label>
            <select class="custom-select d-block w-100" id="country" required>
              <option value="">Kies...</option>
              <option>België</option>
            </select>
            <div class="invalid-feedback">
              Geef a.u.b. een bestaand land in.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="postcode" class="label-light">Postcode</label>
            <input type="text" class="form-control" id="postcode" placeholder="" required>
            <div class="invalid-feedback">
              Je postcode is een verplicht veld.
            </div>
          </div>
        </div>
        <hr class="mb-4">

        <h4 class="mb-3">Betaling</h4>

        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
            <label class="custom-control-label" style="color: #ebebeb;" for="credit">Credits card</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" style="color: #ebebeb;" for="paypal">Your life</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cc-name" class="label-light">Naam op de kaart</label>
            <input type="text" class="form-control" id="cc-name" placeholder="" required>
            <small class="text-muted">Volledige naam zoals op de kaart</small>
            <div class="invalid-feedback">
              De naam op de kaart is een verplicht veld.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="cc-number" class="label-light">Credits card nummer</label>
            <input type="text" class="form-control" id="cc-number" placeholder="" required>
            <div class="invalid-feedback">
              Het credits card nummer is een verplicht veld.
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="cc-expiration" class="label-light">Vervaldatum</label>
            <input type="date" class="form-control" id="cc-expiration" placeholder="" required>
            <div class="invalid-feedback">
              De vervaldatum is een verplicht veld.
            </div>
          </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Ga verder naar betalen</button>
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
