<!DOCTYPE html>
<?php
 session_start();
 
if(count($_POST)>0)
{
    if(!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] =array('TennisBall'=>'0','GolfBall'=>'0','Football'=>'0');
    }
    
    if(isset($_POST['delete']))
    {
        deleteCart();
    }
    if(isset($_POST['add']))
    {
        addToCart();
    }
    else // we must be REMOVING
    {
        removeToCart();
    }
}
function productInCart($ballID)
{
    foreach($_SESSION['cart'] as $key=>$details)
    {
        if($key[$details] == 1) //// XXXXXXX
        {
            return true;
        }
    }
    return false;
}
function checkExists($ballID)
{
    $balls = array(
    'TennisBall'=>array('imgPath'=>'tb.jpg','name'=>'Spalding', 'colour'=>'green', 'price'=>'2.00'),
    'GolfBall'=>array('imgPath'=>'gb.jpg','name'=>'Titlest', 'colour'=>'white', 'price'=>'4.00'),
    'Football'=>array('imgPath'=>'fb.jpg','name'=>'Sherrin', 'colour'=>'maroon', 'price'=>'98.00'));
    
    foreach($balls as $key=>$value)
    {
        if($key == $ballID)
        {
            return true;
        }
    }
    return false;
}

function addToCart()
{
    if(isset($_POST['ballID']))
    {
        // make sure this ball is one of our products - does this id exist in our product array
        if(checkExists($_POST['ballID']))
        {
            // make sure this ball is not already in the cart

                if(!productInCart($_POST['ballID']))
                {
                    // get ready to add it to the cart
                    $_SESSION['cart'][$_POST['ballID']] = 1; 
                
                }
            
        }
    
    }




}

function deleteCart()
{
    unset($_SESSION['cart']);
}

function showItems()
{
$balls = array(
    'TennisBall'=>array('imgPath'=>'tb.jpg','name'=>'Spalding', 'colour'=>'green', 'price'=>'2.00'),
    'GolfBall'=>array('imgPath'=>'gb.jpg','name'=>'Titlest', 'colour'=>'white', 'price'=>'4.00'),
    'Football'=>array('imgPath'=>'fb.jpg','name'=>'Sherrin', 'colour'=>'maroon', 'price'=>'98.00'));
    
foreach($balls as $key=>$value)
{
?>
<article>
                <img src="imgs/<?php echo $balls[$key]['imgPath']; ?>">
                <label>Brand:</label><?php echo $balls[$key]['name']; ?><br>
                <label>Colour:</label><?php echo $balls[$key]['colour']; ?><br>
                <label>Price:</label>$<?php echo $balls[$key]['price']; ?><br><br>
                <form action="" method="post" >
        <?php

        if($key == $_SESSION['cart']) // REMOVE /// XXXXXX
        {
            ?> 
            <input type="submit" name="remove" value="Remove from basket">
            <?php
        }
        else
        { // ADD
            ?> 
            <input type="submit" name="add" value="Add to basket">
            <?php
        }                

        ?>
        <input type="hidden" name="ballID" value="<?php echo $key; ?>">
                </form>
            </article>
            <div style="clear:both">
            </div>
<?php
}
}
?>
<html>
    <head>
        <style>
            body {font-family:calibri;font-size:36px;background:url('imgs/s.png')}
            main {margin:0 auto;width:790px;background: #FFF;border: 3px solid #000;border-radius:10px}
            input[type=submit]{background:green;font-size:28px;color:#FFF;border:2px solid #000;float:right;transition:1s}
            input[type=submit]:hover{background:yellow;font-size:28px;color:green;border:2px solid #000;float:right}
            article{border:2px solid #000; padding:20px;margin:20px;height:225px;width:700px}
            article img{float:left;padding-right:30px}
            article label{width:130px;display:inline-block}
        </style>
    </head>
    <body>
        <main>
            <?php showItems(); ?>
            <form action="" method="post">
                <input type="submit" name="delete">
            </form>
        </main>
    </body>
</html>