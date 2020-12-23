<?php
    if(isset($_POST['submit-order']))
    {
        require 'config.php';
        if(isset($_SESSION['CustomerID']))
        {
            $CustomerID = $_SESSION['CustomerID'];
            $sql = "INSERT INTO Orders (CustomerID) VALUES (" . $_SESSION['CustomerID'] . ");";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../checkout.php?error=sqlerror1");
            }
            else
            {
                mysqli_stmt_execute($stmt);
                $sql = "SELECT OrderID FROM Orders WHERE CustomerID=" . $_SESSION['CustomerID'] . "ORDER BY OrderID DESC LIMIT 1;";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ../checkout.php?error=sqlerror2");
                }
                else
                {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);
                    $OrderID = $row['OrderID'];
                }
                foreach($_SESSION["shopping-cart"] as $item)
                {
                    $sql = "INSERT INTO Order_details (OrderID, ProductID, amount) VALUES (" . $OrderID . "," . $item['ProductID'] . "," . $item['Quantity'] . ");";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql))
                    {
                        header("Location: ../checkout.php?error=sqlerror3");
                    }
                    else
                    {
                        mysqli_stmt_execute($stmt);
                        header("Location: ../betalen.php?success");
                    }
                }
            }
        }
        else
        {
            header("Location= ../checkout.php?error=NoUserSignedIn");
        }
    }
    else
    {
        header("Location= ../checkout.php?error=NoButtonPressed");
    }
?>