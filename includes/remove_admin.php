<?php
    if(isset($_POST['submit-remove-admin']))
    {
        require "config.php";
        $userID = $_POST['user'];
        if(empty($userID))
        {
            header("Location: ../dashboard.php?error=NotEnoughData");
        }
        else
        {
            $sql = "UPDATE Customers SET admin = 0 WHERE CustomerID = " . $userID . ";";
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