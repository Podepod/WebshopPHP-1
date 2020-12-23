<?php
    $load = $_POST['loadProduct'];
    require "includes/config.php";
    if($load == "Lightsabers")
    {
        $sql = "SELECT * FROM Products WHERE name LIKE '%Light Saber%';";
    }
    else
    {
        $sql = "SELECT * FROM Products;";
    }
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0)
    {
        $i = 0;
        while($row = mysqli_fetch_assoc($result))
        {
            if($i == 0)
            {
                echo('<div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">');
            }
            echo('<div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">');
            echo('<div class="my-3 py-3">');
            echo('<h2 class="display-5">' . $row['name'] . '</h2>');
            echo('<p>Prijs: ' . $row['price'] . '</p>');
            echo('</div>');
            echo('<div class="bg-light shadow-sm mx-auto" style="width: 80%; height: 400px; border-radius: 21px 21px 0 0;">');
            echo('<img src="images/products/' . $row['image_name'] . '" alt="Product image" style="max-width: 250px;">');
            echo('<form action="checkout.php" method="POST">
                <input type="number" name="Quantity" value="1" style="max-width: 100px;">
                <input type="hidden" name="ProductID" value="' . $row['ProductID'] . '">
                <button name="submit-add" class="btn btn-primary">Toevoegen</button>
                </form>');
            echo('</div>');
            echo('</div>');
            if($i == 1)
            {
                echo('</div>');
            }
            $i++;
            if($i == 2)
            {
                $i = 0;
            }
        }
        if($resultCheck % 2 == 1)
        {
            echo('</div>');
        }
    }
    else
    {
        header("Location: ../products.php?error=noProducts");
    }
?>