<?php
    if(isset($_POST['submit-product']))
    {
        require 'config.php';
        $name = $_POST['name'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];
        if($_POST['image'] != "")
        {
            $image = $_POST['image'];
            $sql = "INSERT INTO Products (name, stock, price, image) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../register.php?error=sqlerror1");
            }
            else
            {
                mysqli_stmt_bind_param($stmt, "sssss", $name, $stock, $price, $image);
                mysqli_stmt_execute($stmt);
            }
        }
        else
        {
            $sql = "INSERT INTO Products (name, stock, price) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../register.php?error=sqlerror1");
            }
            else
            {
                mysqli_stmt_bind_param($stmt, "sssss", $name, $stock, $price);
                mysqli_stmt_execute($stmt);
            }
        }
    }
?>