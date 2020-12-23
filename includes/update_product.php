<?php

    if(isset($_POST['submit-update-product']))
    {
        require 'config.php';
        $productID = $_POST['product'];
        $name = $_POST['name'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];
        $sql = "UPDATE Products SET name=?, stock=?, price=? WHERE ProductID = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../register.php?error=sqlerror2");
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "ssss", $name, $stock, $price, $productID);
            mysqli_stmt_execute($stmt);
            header("Location: ../dashboard.php?EditSuccess");
        }
    }
    else
    {
        header("Location: ../dashboard.php?error=button_not_pressed");
    }
?>