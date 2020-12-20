<?php
  if($_POST["submit"] == "Signin")
  {
    require "config.php";
    $mail = $_POST['email'];
    $password = $_POST['password'];
    if(empty($mail) || empty($password))
    {
      header("Location: ../sign_in_page.php?error=NogEnoughData");
    }
    else
    {
      $sql = "SELECT * FROM Customers WHERE email_address=?;";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql))
      {
        header("Location: ../sign_in_page.php?error=SQL_error1");
      }
      else
      {
        mysqli_stmt_bind_param($stmt, "s", $mail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result))
        {
          $pwdCheck = password_verify($password, $row['password']);
          if($pwdCheck == false)
          {
            header("Location: ../sign_in_page.php?error=wrongpassword");
          }
          else if ($pwdCheck == true)
          {
            session_start();
            $_SESSION['email'] = $row['email_address'];
            $_SESSION['naam'] = $row['voornaam'];
            $_SESSION['CustomerID'] = $row['CustomerID'];
            $_SESSION['Admin'] = $row['admin'];
            header("Location: ../index.php");
          }
          else
          {
            header("Location: ../sign_in_page.php?error=pwdisnopwd");
          }
        }
        else
        {
          header("Location: ../sign_in_page.php?error=nouser");
        }
      }
    }
  }
  else
  {
    header("Location: ../sign_in_page.php?error=SubmitNotSet");
  }
?>
