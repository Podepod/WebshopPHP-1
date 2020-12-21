<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="nl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Galactic Empire Sith Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel='icon' href='GESS.ico' type='image/x-icon'/>
    <link rel="stylesheet" href="styles/dashboard.css">
  </head>
  <body>
    <header class="masthead mb-auto">
      <div class="inner">
        <h3 class="masthead-brand text-light" style="text-align:center;">Galactic Empire Sith Shop</h3>
        <nav class="nav nav-masthead justify-content-center">
          <a class="nav-link" href="index.php">Home</a>
          <a class="nav-link" href="products.php">Producten</a>
          <a class="nav-link" href="includes/sign_out.php">Logout</a>
        </nav>
      </div>
    </header>
    <div style="margin: 75px; max-height: 30%;">
        <h2 class="text-light">Bestellingen</h2>
        <table class="table text-light">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Customer</th>
                <th scope="col">Orderdate</th>
                <th scope="col">Total price</th>
                <th scope="col">Payed? Y/N</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>14-01-2020</td>
                <td>€1250</td>
                <td>N</td>
              </tr>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>14-01-2020</td>
                <td>€1250</td>
                <td>N</td>
              </tr>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>14-01-2020</td>
                <td>€1250</td>
                <td>N</td>
              </tr>
            </tbody>
          </table>
    </div>
    <div style="margin: 75px; max-height: 30%;">
        <h2 class="text-light">Producten</h2>
        <table class="table text-light">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product</th>
                <th scope="col">In stock</th>
                <th scope="col">Prijs per stuk</th>
              </tr>
            </thead>
            <tbody>
            <?php
              require "includes/config.php";
              $sql = "SELECT * FROM Products;";
              $stmt = mysqli_stmt_init($conn);
              if(!mysqli_stmt_prepare($stmt, $sql))
              {
                header("Location: ../sign_in_page.php?error=SQL_error1");
              }
              else
              {
                mysqli_stmt_execute($stmt);
                while($row = mysqli_fetch_assoc($stmt))
                {
                  echo('<tr>');
                  echo('<th scope="row">' . $row['ProductID'] . '</th>');
                  echo('<td>' . $row['name'] . '</td>');
                  echo('<td>' . $row['stock'] . '</td>');
                  echo('<td>' . $row['price'] . '</td>');
                  echo('</tr>');
                }
              }
            ?>
            </tbody>
        </table>
        <h3 class="text-light">Product toevoegen</h3>
        <form class=" text-light" action="includes/add_product.php" method="POST">
            <div class="form-group">
                <label for="productname">Productnaam</label>
                <input class="form-control" id="productname" name="name" placeholder="Enter productname">
            </div>
            <div class="form-group">
                <label for="stock">In Stock</label>
                <input type="number" name="stock" step="1" id="stock">
            </div>
            <div class="form-group">
                <label for="priceperpiece">Price per piece</label>
                <input type="number" name="price" step=".01" id="priceperpiece">
            </div>
            <div class="form-group">
                <label for="image">Productafbeelding naam</label>
                <input class="form-control" name="image" id="image" placeholder="Enter image path">
            </div>
            <button type="submit" class="btn btn-primary" name="submit-product">Add</button>
        </form>
    </div>
    <div style="margin: 75px;">
        <h3 class="text-light">Administrator toevoegen</h3>
        <form method="POST">
            <select class="mdb-select md-form">
                <option value="" disabled selected>Kies een gebruiker</option>
                <option value="1">Bart Simons</option>
                <option value="2">Bart Simons</option>
                <option value="3">Bart Simons</option>
            </select>
            <button type="submit" class="btn btn-primary">Toevoegen</button>
        </form>
    </div>
    <div style="margin: 75px;">
        <h3 class="text-light">Administrator verwijderen</h3>
        <form method="POST">
            <select class="mdb-select md-form">
                <option value="" disabled selected>Kies een gebruiker</option>
                <option value="1">Bart Simons</option>
                <option value="2">Bart Simons</option>
                <option value="3">Bart Simons</option>
            </select>
            <button type="submit" class="btn btn-primary">Verwijderen</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>
