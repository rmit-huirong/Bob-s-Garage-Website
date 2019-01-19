<?php 
	session_start();
	error_reporting(0);
    include('PUMPS php file/top-part.php');
    include('/assisgnments/a5/stylesheet2.css');
    $warning = "";
if(count($_POST)>0)
{
    if(!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] =array('GB96CSUN'=>'0','TK39TLSIG'=>'0','GP8002'=>'0');
    }

    if(isset($_POST['checkout']))
    {
        validCheck();
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

function productInCart($PID)
{
    foreach($_SESSION['cart'] as $key=>$details)
    {
        if($key[$details] == 1) //// it it in the cart 
        {
            $_SESSION['cart'][$_POST['PID']] = 1; 
            return true;
        }
    }
    return false;
}
function checkExists($PID)
{
  	$pumps = array('GB96CSUN'=>array(
					'title'=>'GB96CSUN 1938 Gilbert & Barker Model 96C Sunray',
					'description'=>'Beautiful authentic yellow and orange paint scheme highlight this Sunray Gilbert & Barker early electric gas pump. Completely restored inside and out. Correct Gilbarco nozzle. Museum quality. (Rolling Stand Not Included) ',
					'price'=>'5495',
					'imgpath'=>'../a1/image/goodstwo.gif'),
		   		  'TK39TLSIG'=>array(
					'title'=>'TK39TLSIG 1939 Tokheim Model 39 (Tall) Signal Gasoline',
					'description'=>'Impressive size and paint scheme, this Tokheim 39 Tall Signal Gasoline pump signaled that the end of the pre-war, "tall" pump era was coming to a close. This magnificent example with it\'s vintage gas brand is near mint. Completely restored. Correct Tokheim nozzle. Near mint. (Rolling Stand Not Included) ',
					'price'=>'6495',
					'imgpath'=>'../a1/image/goodsthree.gif'),
				  'GP8002'=>array(
					'title'=>'GP8002 1947 Tokheim Model 39 Cut-Down',
					'description'=>'Interesting example of a post-war Tokheim Cut Down 39 (Tall). Ad glass over the window. Texaco green and red',
					'price'=>'5495',
					'imgpath'=>'../a1/image/goodsOne.jpg'));
    
    foreach($pumps as $key=>$value)
    {
        if($key == $PID)
        {
            return true;
        }
    }
    return false;
}

function addToCart()
{
    if(isset($_POST['PID']))
    {
        // make sure this ball is one of our products - does this id exist in our product array
        if(checkExists($_POST['PID']))
        {
            // make sure this ball is not already in the cart

                if(!productInCart($_POST['PID']))
                {
                    // get ready to add it to the cart
                    $_SESSION['cart'][$_POST['PID']] = 1; 
                }
        }
    }
}
function removeToCart()
{
    $_SESSION['cart'][$_POST['PID']] = 0; 
}
function validCheck()
{
    // if((count($_POST)>0)&& (!empty($_POST['name']))&& (!empty($_POST['phoneNumber']))
    //  && (!empty($_POST['email']))&& (!empty($_POST['address'])))
    // {

    //     if(!filter_var($_POST['name'],FILTER_VALIDATE_INT)
    //      &&!filter_var($_POST['phoneNumber'],FILTER_VALIDATE_INT)
    //      &&!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)
    //      &&!filter_var($_POST['address'],FILTER_VALIDATE_MAC))
    //     {
    //         filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    //         filter_var($_POST['phoneNumber'],FILTER_SANITIZE_NUMBER_INT);
    //         filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    //         filter_var($_POST['address'],FILTER_SANITIZE_STRING);
    //     }
    //      writetocsv("orders.tsv");
    // }
    // else
    // {
    //      $warning = "<span style='color:red'> Name and telephone and address and email cannot be empty! </span> ";
    //     header("Location: pumps.php");
    // }   
}
  if ($_SESSION['checkbox'] == on)
  {
    

  }

?>
<title>pumps</title>
<?php
    include('PUMPS php file/middle-part.php');
?>
<?php
function showItems()
{
	$pumps = array('GB96CSUN'=>array(
					'title'=>'GB96CSUN 1938 Gilbert & Barker Model 96C Sunray',
					'description'=>'Beautiful authentic yellow and orange paint scheme highlight this Sunray Gilbert & Barker early electric gas pump. Completely restored inside and out. Correct Gilbarco nozzle. Museum quality. (Rolling Stand Not Included) ',
					'price'=>'5495',
					'imgpath'=>'../a1/image/goodstwo.gif'),
		   		  'TK39TLSIG'=>array(
					'title'=>'TK39TLSIG 1939 Tokheim Model 39 (Tall) Signal Gasoline',
					'description'=>'Impressive size and paint scheme, this Tokheim 39 Tall Signal Gasoline pump signaled that the end of the pre-war, "tall" pump era was coming to a close. This magnificent example with it\'s vintage gas brand is near mint. Completely restored. Correct Tokheim nozzle. Near mint. (Rolling Stand Not Included) ',
					'price'=>'6495',
					'imgpath'=>'../a1/image/goodsthree.gif'),
				  'GP8002'=>array(
					'title'=>'GP8002 1947 Tokheim Model 39 Cut-Down',
					'description'=>'Interesting example of a post-war Tokheim Cut Down 39 (Tall). Ad glass over the window. Texaco green and red',
					'price'=>'5495',
					'imgpath'=>'../a1/image/goodsOne.jpg'));
    //$_SESSION['pumps'] = $pumps;
		foreach ($pumps as $pumpID=> $value)
		{
?>
        <?php
			echo '<form  class = "form" action="" method = "post">';
			echo '< img src = "'.$value['imgpath'].'" class = "img">';
			echo $value['title'].'<br>';
			echo $value['description'].'<br>';
			echo "$";
			echo $value['price'];
			echo '<input type ="hidden" name="PID" value ="'.$pumpID.'">';
		?>
        <?php
        if($_SESSION['cart'][$pumpID]==1) 
        {
            ?> 
            <input type="submit" name="remove" value="Remove from cart">
            <?php
        }
        else
        { 
            ?> 
            <input type="submit" name="add" value="Add to cart">
            <?php
        }                
        ?>
        <?php
            echo '</form>'
        ?> 
<?php
}
}
?>	


<?php
 showItems();
 include('PUMPS php file/top-part.php');
?>

	<aside>
	    <form action='/assisgnments/a5/receipts.php' method ='post'>
	    <fieldset>
	        <legend>Please tell us your detial</legend>
	        <p><label for="name">Name:</label><br/>
	            <input type='text' name='name' id ="name" placeholder = 'e.g. puppy' required /></p >
	        <p><label for="email">Email:</label><br/>
	            <input type='email' id ="email" name= 'email' placeholder = 'e.g. XXXX@.email'required /></p >
	        <p><label for="address">Address:</label><br/>
	            <textarea id="address" name = 'address' cols='40' rows='4' >
	                </textarea></p >
	         <p>
	         	<label for="phoneNumber">PhoneNumber:</lable><br>
	         <input 
	        		type="text" 
	        		name="phoneNumber" 
	        		placeholder="Enter your phone" 
	        		pattern="[0-9/+/(/)x ]*"
	        		id ="phoneNumber"
	        		class="phoneNumber"
	        		onchange="remove();NAPAcheck()"
	        		oninput="NAPAcheck()"
	       >
	       
	        < img id="image" src="/assisgnments/a3/NANP.png"height=20px   style="display:none" />
	         </p >
	         <p>
	         <input id="checkbox" type="checkbox" onclick='rememberMe()' name="checkbox"   />
	         <label for="checkbox">RememberMe</lable>
	         </p >
	        <input type ='submit' name='checkout' value='checkout'/>
            <p><?php echo $warning; ?></p >	              
	      <?php  echo '<pre>' . print_r($_SESSION['USER'], TRUE) . '</pre>'; ?>
	    </fieldset>
	    </form>
	    <fieldset>
  		<legend>LocalStorage Replacement Tools - Get Well Soon Chrome!</legend>
  <div>
    <input type='button' value='Log' onclick='console.log(localStorage);' / >
    <input type='button' value='Clear' onclick='localStorage.clear();' / >
  </div>
		</fieldset>
	</aside>
<?php
    include('PUMPS php file/end-part.php');
  ?>