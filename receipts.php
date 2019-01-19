<!DOCTYPE html>
<?php
    session_start();
    if(count($_POST)>0)
    {
        if(isset($_POST['checkout']))
        {
            checkout();
        }
    }
    
    // validate and sanitize the user details
    function checkout()
    {
        if(!empty($_POST['name']))
        {
            $namePattern = '/^[a-zA-Z]+[ ]*$/';
            if(preg_match($namePattern, $_POST['name']) == 1)
            {
                $_SESSION['name'] = $_POST['name'];
                $name = $_SESSION['name'];
            }
            else
            {
                $nameWarning = "Please enter a valid name.";
                echo "<script type='text/javascript'>alert('$nameWarning');
                window.history.back();
                </script>";
                return false;
            }
        }
        else
        {
            $nameWarning = "Please enter a valid name.";
            echo "<script type='text/javascript'>alert('$nameWarning');
            window.history.back();
            </script>";
            return false;
        }
        if(!empty($_POST['phone']))
        {
            $phonePattern = '/^[0-9 \+\(\)x]*$/';
            if(preg_match($phonePattern, $_POST['phone']) == 1)
            {
                $_SESSION['phone'] = $_POST['phone'];
                $phone = $_SESSION['phone'];
            }
            else
            {
                $phoneWarning = "Please enter a valid phone.";
                echo "<script type='text/javascript'>alert('$phoneWarning');
                window.history.back();
                </script>";
                return false;
            }
        }
         else
        {
            $phoneWarning = "Please enter a valid phone.";
            echo "<script type='text/javascript'>alert('$phoneWarning');
            window.history.back();
            </script>";
            return false;
        }
        if(!empty($_POST['email']))
        {
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
            {
                $_SESSION['email'] = $_POST['email'];
                $email = $_SESSION['email'];
            }
            else
            {
                $emailWarning = "Please enter a valid email.";
                echo "<script type='text/javascript'>alert('$emailWarning');
                window.history.back();
                </script>";
                return false;
            }
        }
        else
        {
            $emailWarning = "Please enter a valid email.";
            echo "<script type='text/javascript'>alert('$emailWarning');
            window.history.back();
            </script>";
            return false;
        }
        if(!empty($_POST['address']))
        {
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $_SESSION['address'] = $address;
        }
        else
        {
            $addressWarning = "Please enter a valid address.";
            echo "<script type='text/javascript'>alert('$addressWarning');
            window.history.back();
            </script>";
            return false;
        }

        $details=array($name,$phone,$email,$address);
        foreach($_SESSION['cart'] as $key => $quantity) 
        {
            if($quantity == 1)
            {
                $details[]=$key;
            }
        }
        
        $orderlist=array($details);
                        
        $filename = 'orders.tsv';
        $fp = fopen($filename,'w');
        $delimiter="\t";
        foreach ($orderlist as $value) 
        {
            fputcsv($fp, $value, $delimiter);
        }
        fclose($fp);
        
        return true;
    }
    
    // calculate total price
    function calPrice()
    {
        $totalPrice = 0.00;
        foreach($_SESSION['cart'] as $key => $quantity) 
        {
            if($quantity == 1)
            {
                foreach ($_SESSION['price'] as $pumpID => $price) 
                {
                    if($key == $pumpID)
                    {
                        $totalPrice += $price;
                    }
                }
            }
        }
        return $totalPrice;
    }
    
    include('top-part.php');
?>
        <title>Receipt</title>
    </head>
    <body>
        <header>
            <img src="gif/gasboy_150.gif" style="width:130px;height:150px;" alt="Bob's Garage">
            <link rel="stylesheet" type="text/css" href="style.css">
            Bob's Garage Receipt
        </header>
        <main>
            <article>
                <h2>ORDER NO</h2>
                <?php
                    echo '20170529123';
                    
                ?>
                <h2>CUSTOMER DETAIL</h2>
                <h3>Name</h3>
                <?php
                    echo $_SESSION['name'];
                ?>
                <h3>Phone</h3>
                <?php
                    echo $_SESSION['phone'];
                ?>
                <h3>Email</h3>
                <?php
                    echo $_SESSION['email'];
                ?>
                <h3>Address</h3>
                <?php
                    echo $_SESSION['address'];
                ?>
                <h2>ORDER ITEM</h2>
                <?php
                    foreach($_SESSION['cart'] as $key => $quantity) 
                    {
                        if($quantity == 1)
                        {
                            echo $key;
                            echo " ( Quantity is ";
                            echo $quantity;
                            echo " )"."\t";
                        }
                    }
                ?>
                <h2>TOTAL PRICE</h2>
                <?php
                    $price=calPrice();
                    printf("$%1.2f", $price); 
                ?>
            </article>
            </article
        </main>
        <footer>
            <?php
                echo '<br>';
                echo 'Address: 4140 JVL Industrial Park Dr. #102<br>';
                echo 'Marietta, GA 30066 (Just off I-575)<br>';
                echo 'Phone: 678-494-2996<br>';
                echo 'Fax: 678-494-1076<br>';
                echo 'Hours of Operation: M-F 10-4 Sat by appointment<br>';
                echo 'Send us Email: Bob@Bobs-Garage.com';
            ?>
        </footer>
    </body>
</html>