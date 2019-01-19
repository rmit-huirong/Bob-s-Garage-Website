<!DOCTYPE html>
<?php
    session_start();
    $_SESSION['price']=array('RGP300'=>'5495.00','GB96CSUN'=>'5495.00','TK39TLSIG'=>'6495.00');
    if(count($_POST)>0)
    {
        if(!isset($_SESSION['cart']))
        {
            $_SESSION['cart']=array('RGP300'=>'0','GB96CSUN'=>'0','TK39TLSIG'=>'0');
        }
        if(isset($_POST['remove']))
        {
            removeFromCart();
        }
        if(isset($_POST['add']))
        {
            addToCart();
        }
        if(isset($_POST['delete']))
        {
            deleteCart();
        }
    }
    
    // to check if the specific pump is already in the cart
    function pumpInCart($pumpID)
    {
        if(isset($_SESSION['cart']))
        {
            foreach($_SESSION['cart'] as $key => $quantity)
            {
                if($key == $pumpID)
                {
                    if($quantity == 1)
                    {
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
    $pumps = array('RGP300'=>array('title'=>'1957 Tokheim Model 300 restored to Flying A', 'description'=>'Classic design, beautifully restored.<br>(Rolling Stand Not Included)', 'price'=>'5495.00', 'imgPath'=>'pumps/RGP300.jpg'),
                   'GB96CSUN'=>array('title'=>'1938 Gilbert & Barker Model 96C Sunray', 'description'=>'Beautiful authentic yellow and orange paint scheme highlight this Sunray Gilbert & Barker early electric gas pump. Completely restored inside and out. Correct Gilbarco nozzle. Museum quality.<br>(Rolling Stand Not Included)', 'price'=>'5495.00', 'imgPath'=>'pumps/GB96CSUN.gif'),
                   'TK39TLSIG'=>array('title'=>'1939 Tokheim Model 39 (Tall) Signal Gasoline', 'description'=>'Impressive size and paint scheme, this Tokheim 39 Tall Signal Gasoline pump signaled that the end of the pre-war, "tall" pump era was coming to a close. This magnificent example with it is vintage gas brand is near mint. Completely restored. Correct Tokheim nozzle. Near mint.<br>(Rolling Stand Not Included)', 'price'=>'6495.00', 'imgPath'=>'pumps/TK39TLSIG.gif'));
    
    // to check if the specific pump is on sale (in product list)
    function checkExists($pumpID)
    {
        $pumps = array('RGP300'=>array('title'=>'1957 Tokheim Model 300 restored to Flying A', 'description'=>'Classic design, beautifully restored.<br>(Rolling Stand Not Included)', 'price'=>'5495.00', 'imgPath'=>'pumps/RGP300.jpg'),
                       'GB96CSUN'=>array('title'=>'1938 Gilbert & Barker Model 96C Sunray', 'description'=>'Beautiful authentic yellow and orange paint scheme highlight this Sunray Gilbert & Barker early electric gas pump. Completely restored inside and out. Correct Gilbarco nozzle. Museum quality.<br>(Rolling Stand Not Included)', 'price'=>'5495.00', 'imgPath'=>'pumps/GB96CSUN.gif'),
                       'TK39TLSIG'=>array('title'=>'1939 Tokheim Model 39 (Tall) Signal Gasoline', 'description'=>'Impressive size and paint scheme, this Tokheim 39 Tall Signal Gasoline pump signaled that the end of the pre-war, "tall" pump era was coming to a close. This magnificent example with it is vintage gas brand is near mint. Completely restored. Correct Tokheim nozzle. Near mint.<br>(Rolling Stand Not Included)', 'price'=>'6495.00', 'imgPath'=>'pumps/TK39TLSIG.gif'));
        foreach($pumps as $key => $value)
        {
            if($pumpID == $key)
            {
                return true;
            }
        }
        return false;
    }
    
    // add a pump to the cart
    function addToCart()
    {
        if(isset($_POST['pumpID']))
        {
            if(checkExists($_POST['pumpID']))
            {
                if(!pumpInCart($_POST['pumpID']))
                {
                    $_SESSION['cart'][$_POST['pumpID']] = 1;
                }
            }
        }
    }
    
    // remove a pump from the cart
    function removeFromCart()
    {
        $_SESSION['cart'][$_POST['pumpID']] = 0;
    }
    
    //delete all the pumps in the cart if neccessary
    function deleteCart()
    {
        unset($_SESSION['cart']);
    }
    
    include('top-part.php');
?>

        <title>Pumps</title>
        
<?php
    include('mid-part.php');
?>
            <p id="pumps">Gas Pumps</p><br>
            <img src="gif/cart.gif" style="width:35px;height:20px;" alt="Add to cart">Click on a shopping cart to add to your order.
            <section>
                <h3>ALWAYS BUYING OLD GAS PUMPS AND SODA MACHINES</h3>
                <article>
<?php
    foreach($pumps as $key => $value)
    {
        echo '<div class="item" id="pump-'.$key.'">';
        echo '<img src="'.$value['imgPath'].'" class="itemImg">';
        echo $value['title'].'<br><br>';
        echo $value['description'].'<br><br>';
        echo $key.'<br>';
        echo '$'.$value['price'].'<br>';
        echo '<form action="pumps.php" method="post">';
        echo '<input type="hidden" name="pumpID" value="'.$key.'">';
        if($_SESSION['cart'][$key] == 1) 
        {
            echo '<button type="submit" name="remove" value="'.$key.'">';
			echo '<p>Remove from cart</p>';
			echo '</button>';
        }
        else
        {
            echo '<button type="submit" name="add" value="'.$key.'">';
			echo '<p>Add to cart</p>';
			echo '</button>';
        }
        echo '</form>';
        echo '</div>';
        echo '<div class="clearBoth">';
		echo '</div>';
    }
?>
                </article>
            </section>
            <section>
                <fieldset>
                    <legend  class="titles">Please submit your details:</legend>
                    <article id="form">
                        <form action="receipts.php" method="post">
                        <p><label for="name">Name:</label><br><input type="text" id="name" name="name"></p>
                        <p><label for="phone">Phone:</label><br><input type="tel" id="phone" name="phone" pattern="[0-9 \+\(\)x]+" oninput="nanpCheck()" onchange="remove();nanpCheck();" /><img src="png/NANP.png" id="nanp" style="width:22px; height:26px; display:none;"</p>
                        <p><label for="email">Email:</label><br><input type="email" id="email" name="email" placeholder="e.g.bob@bobsgarage.com"></p>
                        <p><label for="address">Address:</label><br><textarea cols="80" rows="6" id="address" name="address"></textarea></p>
                        <p><label for="rememberMe">Remember me </label><input type="checkbox" id="rememberMe" name="rememberMe" value="true" onclick="remember()"></p>
                        <p><input type="submit" name="checkout" value="SUBMIT" /></p>
                        </form>
                    </article>
                </fieldset>
            </section>
            <aside>
                <h4><a href="pumps/more.html"><img src="gif/Redbull.gif" alt="More Pumps" style="width=18px;height:18px;"></a>Click Here for <b><a href="pumps/more.html">More Antique Pumps</a></b></h4>
                <h4><a href="pumps/repro.html"><img src="gif/Redbull.gif" alt="Reproduction Pumps" style="width=18px;height:18px;"></a>Click Here for <b><a href="pumps/repro.html">Reproduction Pumps</a></b></h4>
                <h4><a href="globes/index.html"><img src="gif/Redbull.gif" alt="Globes" style="width=18px;height:18px;"></a>Click Here for gas pump <b><a href="globes/index.html">Globes</a></b></h4>
                <p><a href="pumps/cgp.html">Custom pump work</a> done on request.<br>
                Good selection of unrestored pumps available from $550 up.<br>
                Pump type limited to stock on hand. Call Bob for availability.<br>
                We also do gas pump and soda machine restoration estimates.</p>
            </aside>
<?php
    include('end-part.php');
?>