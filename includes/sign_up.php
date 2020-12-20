<?php
    if(isset($_POST['signup-submit']))
    {
        require 'config.php';
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $birthdate = $_POST['birthdate'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $postcode = $_POST['postcode'];
        $pwd = $_POST['password'];

        $sql = "SELECT * FROM Customers WHERE email_address=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../register.php?error=sqlerror1");
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if($resultcheck > 0)
            {
                header("Location: ../register.php?error=userexists&email=".$email);
            }
            else
            {
                $sql = "INSERT INTO Customers (first_name, last_name, email_address, birth_date, password) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ../register.php?error=sqlerror2");
                }
                else
                {
                    $passwordHashed = password_hash($pwd, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $email, $birthdate, $passwordHashed);
                    mysqli_stmt_execute($stmt);

                    //Add address to the address table
                    $sql = "SELECT CustomerID FROM Customers WHERE email_address=?;";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql))
                    {
                        header("Location: ../register.php?error=sqlerror3");
                    }
                    else
                    {
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if($row = mysqli_fetch_assoc($result))
                        {
                            $CID = $row['CustomerID'];
                            $sql = "INSERT INTO Addresses (country, city, street_and_nr, postalcode, CustomerID) VALUES (?, ?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql))
                            {
                                header("Location: ../register.php?error=sqlerror4");
                            }
                            else
                            {
                                mysqli_stmt_bind_param($stmt, "sssss", $country, $city, $address, $postcode, $CID);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../index.php");
                            }
                        }
                        else
                        {
                            header("Location: ../register.php?error=nouser");
                        }
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    else
    {
        header("Location: ../register.php?error=button_not_pressed");
    }
?>
