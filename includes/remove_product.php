<?php
    if(isset($_POST['submit-remove-product']))
    {
        require "config.php";
        $productID = $_POST['product'];
        if(empty($productID))
        {
            header("Location: ../dashboard.php?error=NotEnoughData");
        }
        else
        {
            $sql = "DELETE FROM Products WHERE ProductID = " . $productID . ";";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../dashboard.php?error=SQL_error1");
            }
            else
            {
                mysqli_stmt_execute($stmt);
                header("Location: ../dashboard.php?success");
            }
        }
    }
    else
    {
      header("Location: ../dashboard.php?error=SubmitNotSet");
    }
?>