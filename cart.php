<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Shop</title>


<link rel="stylesheet" href="styles/style.css" media="all" />
</head>
<body>
 
<!-- main content starts-->
<div class="main_wrapper">
     <div class="header_wrapper">
     
     <a href="index.php"><img src="images/header2.gif" style="float:left" /></a>
     <img src="images/header1.jpg" style="float:right"  />
     
     </div>
     <div id="navbar">
     
     <ul id="menu">
     
     <li><a href="index.php">Home</a></li>
     <li><a href="all_products.php">All Products</a></li>
     <li><a href="">My Account</a></li>
     <li><a href="login.php">Sign Up</a></li>
     <li><a href="cart.php">Shopping cart</a></li>
     <li><a href="contact.php">Contact us</a></li>     
    
     
     <div id="search">
     <form method="get" action="results.php" enctype="multipart/form-data">
     <input type="text" name="query" placeholder="Search a product:"  />
     <input type="submit" name="submit" value="Submit"/>
     
     </form>
     
      </ul>
     </div>    
     
</div>
     
  <div class="content_wrapper">
  <?php
cart();
?>
    <div id="left_area">
          
          		<div id="title">Categories </div>
                
                <ul id="cat">
                
                <?php
				
				getcat();
				?>	            
          		</ul>
    </div>
    <div id="right_area">
    
    	<div id="headline">
        <b> Welcome Guest!</b>
        <b style="color:#99C">Shopping Cart:  </b>
        <span>Items:<?php tot_items();?> Total Price:<?php tot_price();?></span>
        </div>

		<div>
		
        <form method="post" action="cart.php" enctype="multipart/form-data">
		<table width="700">
		<tr>
        <th width="400">Product</th>
        <th >Quantity</th>
        <th >Price</th>
        <th >SubTotal</th>
		</tr>
        <?php
        global $db;
	$ip=getIp();
	$cart_product="select * from cart where ip_add='$ip'";
    $check_cart=mysqli_query($db,$cart_product);
    while($row_cart=mysqli_fetch_array($check_cart))
                {
                    $total=0;
                    $p_id=$row_cart['p_id'];
                    $p_qty=$row_cart['p_qty'];
                    $cart_product1="select * from products where product_id='$p_id'";
                    $check_cart1=mysqli_query($db,$cart_product1);
                    while($row_cart1=mysqli_fetch_array($check_cart1))
                    {
                    $p_title=$row_cart1['product_title'];
                    $p_price=$row_cart1['product_price'];
                    $p_image=$row_cart1['product_img1'];
                     }
                     $total=$total+($p_qty*$p_price);?>
                     <tr>
                     <td width="400">
                      <img src="admin_area/product_images/<?php echo $p_image?>" height="40px" height="40px"></img>
                     <?php echo $p_title?><br /><div id="remove"><input type="checkbox" name="remove[]" value="<?php echo $p_id;?>">Remove</div>
                    </td>
                     <td ><input type="text" size="3" name="qty" value="<?php echo $p_qty?>"><br />
                     <?php echo "<a href='cart.php?res=$p_id'><button>Save</button></a>";?>
                     </td>
                    
                     <?php

          if(isset($_GET['res'])){
          global $db;
         $ip=getIp();
         $id=$_GET['res'];
              $update_qty=$_POST['qty'];
         $up_product="update cart set p_qty='$update_qty' where p_id='$id'";
         $run_up=mysqli_query($db,$up_product);
              
          if($run_up)
          {
              echo "<script>window.open('cart.php','_self')</script>";
          }
         
      }
?>
                     
                     
                     <td >Rs.<?php echo $p_price?></td>
      			     <td >Rs.<?php echo $total?></td>
		             </tr><?php
				}
         ?>
         <tr>
        <td id="last"><input type="submit" style="font-weight:bold;text-align:left"  name="update" value="Update" />
            <?php echo " "?> 
            
                <a href="all_products.php" style="color: rgb(255,100,100)">Continue Shopping</a>
           </td>
        <td colspan="3" align="right"  style="padding-right:25px">Total Price:     Rs.<?php tot_price()?></td>
		</tr>
        <tr>
        <td id="last2" colspan="4" align="right"  style="padding-right:25px"><button><a href="checkout.php">Place Order</a></button></td>
		</tr>
         </table> 
         </form> 
        </div>
        
        
        
        </div>    
     </div>
</div>

<?php
      if(isset($_POST['update']))
	  {
		  global $db;
		 $ip=getIp();
		  foreach($_POST['remove'] as $remove_id)
		  {
			  $del_pro="delete from cart where p_id='$remove_id' and ip_add='$ip'";
			  $run_del=mysqli_query($db,$del_pro);
			  
		  }
		  if($run_del)
		  {
			  echo "<script>window.open('cart.php','_self')</script>";
		  }
	  }
?>


     <div class="footer_wrapper">
     <h1>&nbsp;</h1>
     <h1>&nbsp;</h1>
     <h1>&copy; 2016 -By Ayush Badraj (14BCE1255)<br> Gaurav Gokani (14BCE1171)</h1>
     </div>
</body>
</html>