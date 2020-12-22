<?php
    if(isset($_POST['submit-product']))
    {
        require 'config.php';
        $name = $_POST['name'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];
        $image = $_FILES['image'];
        if($image)
        {
            $imageName = $image['name'];
            $imageTmp = $image['tmp_name'];
            $imgSize = $image['size'];
            $imgError = $image['error'];

            $imgExt = explode('.',$imageName);
            $imgActualExt = strtolower(end($imgExt));

            $allowedExt = array('jpg', 'jpeg', 'png');

            if(in_array($imgActualExt, $allowedExt))
            {
                if($imgError === 0)
                {
                    if($imgSize <= 5000000) #If imgSize is smaller then or equal to 5MB
                    {
                        $imageNewName = uniqid('', true) . "." . $imgActualExt;
                        $imageDest = "../images/products/" . $imageNewName;
                        move_uploaded_file($imageTmp,$imageDest);
                        $sql = "INSERT INTO Products (name, stock, price, image_name) VALUES (?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql))
                        {
                            header("Location: ../dashboard.php?error=sqlerror1");
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt, "ssss", $name, $stock, $price, $imageNewName);
                            mysqli_stmt_execute($stmt);
                            header("Location: ../dashboard.php?successWithImage=".$imageTmp);
                        }
                    }
                    else
                    {
                        header("Location: ../dashboard.php?error=Size=".$imgSize);
                    }
                }
                else
                {
                    header("Location: ../dashboard.php?error=Error:" . $imgError);
                }
            }
            else
            {
                header("Location: ../dashboard.php?error=FileTypeNotAllowed");
            }
        }
        else
        {
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
    }
    else
    {
        header("Location: ../dashboard.php?error=button_not_pressed");
    }
?>