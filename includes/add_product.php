<?php

    if(isset($_POST['submit-product']))
    {
        require 'config.php';
        $name = $_POST['name'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];
        $sql = "INSERT INTO Products (name, stock, price) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../register.php?error=sqlerror2");
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "sss", $name, $stock, $price);
            mysqli_stmt_execute($stmt);
            header("Location: ../dashboard.php?success");
        }
    }
    else
    {
        header("Location: ../dashboard.php?error=button_not_pressed");
    }
?>