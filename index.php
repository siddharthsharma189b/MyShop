<?php
include("includes/db.php");
include("functions/functions.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

		<div id="product_box">

            <?php
			
			getpro();
			getcatpro();
			?>
        </div>
        
        
        
        </div>    
     </div>
</div>
     <div class="footer_wrapper">
     <h1>&nbsp;</h1>
     <h1>&nbsp;</h1>
     <h1>&copy; 2016 -By Ayush Badraj (14BCE1255)<br>and Gaurav Gokani(14BCE1171)</h1>
     </div>
</body>
</html>