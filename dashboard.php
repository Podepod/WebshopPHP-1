<?php
  session_start();
  require "includes/config.php";
?>
<!DOCTYPE html>
<html lang="nl">
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
              <?php
                $sql = "SELECT * FROM Orders;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck > 0)
                {
                  while($row = mysqli_fetch_assoc($result))
                  {
                    $OrderID = $row['OrderID'];
                    $OrderTime = $row['order_time'];
                    $payed = $row['payed'];
                    $CustomerID = $row['CustomerID'];
                    $som = 0;

                    if($payed == 1)
                    {
                      $payed = 'Y';
                    }
                    else
                    {
                      $payed = 'N';                    
                    }

                    $sql = "SELECT CONCAT(first_name, ' ', last_name) AS Name FROM Customers WHERE CustomerID = " . $CustomerID . ";";
                    $result2 = mysqli_query($conn, $sql);
                    $resultCheck2 = mysqli_num_rows($result2);
                    if($resultCheck2 > 0)
                    {
                      $row2 = mysqli_fetch_assoc($result2);
                      $CustomerName = $row2['Name'];
                    }
                    else
                    {
                      $CustomerName = "Unknown";
                    }

                    $sql = "SELECT ProductID, amount FROM Order_details WHERE OrderID = " . $OrderID . ";";
                    $result3 = mysqli_query($conn, $sql);
                    $resultCheck3 = mysqli_num_rows($result3);
                    if($resultCheck3 > 0)
                    {
                      while($row3 = mysqli_fetch_assoc($result3))
                      {
                        $ProductID = $row3['ProductID'];
                        $amount = $row3['amount'];

                        $sql = "SELECT price FROM Products WHERE ProductID = " . $ProductID . ";";
                        $result4 = mysqli_query($conn, $sql);
                        $resultCheck4 = mysqli_num_rows($result4);
                        if($resultCheck4 > 0)
                        {
                          $row4 = mysqli_fetch_assoc($result4);
                          $price = $row4['price'];
                          $som += ($price * $amount);
                        }
                        else
                        {
                          $som += 0;
                        }
                      }
                    }    
                    else
                    {
                      $som = "Unknown";
                    }
                    echo('<tr>');
                    echo('<th scope="row">' . $OrderID . '</th>');
                    echo('<td>' . $CustomerName . '</td>');
                    echo('<td>' . $OrderTime . '</td>');
                    echo('<td>€' . $som . '</td>');
                    echo('<td>' . $payed . '</td>');
                    echo('</tr>');
                  }
                }
              ?>
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
              $sql = "SELECT * FROM Products;";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);
              if($resultCheck > 0)
              {
                while($row = mysqli_fetch_assoc($result))
                {
                  echo('<tr>');
                  echo('<th scope="row">' . $row['ProductID'] . '</th>');
                  echo('<td>' . $row['name'] . '</td>');
                  echo('<td>' . $row['stock'] . '</td>');
                  echo('<td>€' . $row['price'] . '</td>');
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
        <h3 class="text-light">Product verwijderen</h3>
        <form method="POST" action="includes/remove_product.php">
            <select class="mdb-select md-form" name="product">
            <option value="" disabled selected>Kies een product</option>
              <?php
                    $sql = "SELECT ProductID, name FROM Products ORDER BY name, ProductID;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if($resultCheck > 0)
                    {
                      while($row = mysqli_fetch_assoc($result))
                      {
                        echo('<option value="' . $row['ProductID'] . '">' .$row['name'] . '</option>');
                      }
                    }
                  ?>
            </select>
            <button type="submit" class="btn btn-primary" name="submit-remove-product">Verwijderen</button>
        </form>
    </div>
    <div style="margin: 75px;">
        <h3 class="text-light">Administrator toevoegen</h3>
        <form method="POST" action="includes/add_admin.php">
            <select class="mdb-select md-form" name="user">
            <option value="" disabled selected>Kies een gebruiker</option>
              <?php
                    $sql = "SELECT CustomerID, first_name, last_name FROM Customers WHERE admin = 0 ORDER BY first_name, last_name, CustomerID;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if($resultCheck > 0)
                    {
                      while($row = mysqli_fetch_assoc($result))
                      {
                        echo('<option value="' . $row['CustomerID'] . '">' .$row['first_name'] . ' ' . $row['last_name'] . '</option>');
                      }
                    }
                  ?>
            </select>
            <button type="submit" class="btn btn-primary" name="submit-add-admin">Toevoegen</button>
        </form>
    </div>
    <div style="margin: 75px;">
        <h3 class="text-light">Administrator verwijderen</h3>
        <form action="includes/remove_admin.php" method="POST">
            <select class="mdb-select md-form" name="user">
                <option value="" disabled selected>Kies een gebruiker</option>
                <?php
                  $sql = "SELECT CustomerID, CONCAT(first_name, ' ', last_name) AS Name FROM Customers WHERE admin = 1 ORDER BY Name, CustomerID;";
                  $result = mysqli_query($conn, $sql);
                  $resultCheck = mysqli_num_rows($result);
                  if($resultCheck > 0)
                  {
                    while($row = mysqli_fetch_assoc($result))
                    {
                      echo('<option value="' . $row['CustomerID'] . '">' .$row['Name'] . '</option>');
                    }
                  }
                ?>
            </select>
            <button type="submit" class="btn btn-primary" name="submit-remove-admin">Verwijderen</button>
        </form>
    </div>
    <div style="margin: 75px;">
        <h3 class="text-light">Gebruiker verwijderen</h3>
        <form action="includes/remove_user.php" method="POST">
            <select class="mdb-select md-form" name="user">
                <option value="" disabled selected>Kies een gebruiker</option>
                <?php
                  $sql = "SELECT CustomerID, CONCAT(first_name, ' ', last_name) AS Name FROM Customers ORDER BY Name, CustomerID;";
                  $result = mysqli_query($conn, $sql);
                  $resultCheck = mysqli_num_rows($result);
                  if($resultCheck > 0)
                  {
                    while($row = mysqli_fetch_assoc($result))
                    {
                      echo('<option value="' . $row['CustomerID'] . '">' .$row['Name'] . '</option>');
                    }
                  }
                ?>
            </select>
            <button type="submit" class="btn btn-primary" name="submit-remove-user">Verwijderen</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>