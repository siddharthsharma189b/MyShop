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
        <span>Items: Total Price:</span>
        </div>
    
		<div id="product_box">
     

            <?php
			if(isset($_GET['pro_id']))
			{
				$p_id=$_GET['pro_id'];
			$get_product="select * from products where product_id=$p_id ";
			$run_product=mysqli_query($db,$get_product);
			while($row_product=mysqli_fetch_object($run_product))
			{
				$product_id=$row_product->product_id;
				$product_title=$row_product->product_title;
				$product_img1=$row_product->product_img1;
				$product_img2=$row_product->product_img2;
				$product_img3=$row_product->product_img3;
				$product_desc=$row_product->product_desc;
				$product_price=$row_product->product_price;
				$product_cat=$row_product->category_id;
				echo "<div id='single_content'>
				<h3>$product_title</h3>
				
				<img src='admin_area/product_images/$product_img1' width='180' height='180'></img>
				<img src='admin_area/product_images/$product_img2' width='200' height='200'></img>
				<img src='admin_area/product_images/$product_img3' width='220' height='220'></img><br>
				<p>Product Description:<br>$product_desc</p>
				<b>Price:Rs $product_price</b><br><br>
				<a href='index.php' style='float:left;'>Go back</a>
				<a href='index.php?pro_id=$product_id'><button style='float:right;'>Add to Cart</button></a></div>";
			}
			}
			?>
        </div>
        
        
        
        </div>    
     </div>
</div>
     <div class="footer_wrapper">
     <h1>&nbsp;</h1>
     <h1>&nbsp;</h1>
     <h1>&copy; 2016 -By Gourav jhunjhunwala</h1>
     </div>
</body>
</html>