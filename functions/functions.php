<?php

$db=mysqli_connect("localhost","root","","myshop");
function getpro(){
	global $db;
	if(!isset($_GET['cat'])){
$get_product="select * from products order by rand() limit 0,6 ";
			$run_product=mysqli_query($db,$get_product);
			while($row_product=mysqli_fetch_assoc($run_product))
			{
				$product_id=$row_product['product_id'];
				$product_title=$row_product['product_title'];
				$product_img1=$row_product['product_img1'];
				$product_desc=$row_product['product_desc'];
				$product_price=$row_product['product_price'];
				$product_cat=$row_product['category_id'];
				echo "<div id='single_content'>
				<h3>$product_title</h3>
				
				<a href='details.php?pro_id=$product_id'><img src='admin_area/product_images/$product_img1' width='180' height='180'></img></a><br>
				<b>Price:Rs $product_price</b>
				<a href='details.php?pro_id=$product_id' style='float:left;'>Details</a>
				<a href='index.php?add_cart=$product_id'><button style='float:right;'>Add to Cart</button></a></div>";
			}
			
}
}


function getcatpro(){
	global $db;
	if(isset($_GET['cat'])){
		$cat=$_GET['cat'];
$get_product="select * from products where category_id='$cat' ";
			$run_product=mysqli_query($db,$get_product);
			$count=mysqli_num_rows($run_product);
			if($count==0)
			{
				echo '<h2 style="font-weight:bold">No products found in this category!!!</h2>';
			}
			
			while($row_product=mysqli_fetch_assoc($run_product))
			{
				$product_id=$row_product['product_id'];
				$product_title=$row_product['product_title'];
				$product_img1=$row_product['product_img1'];
				$product_desc=$row_product['product_desc'];
				$product_price=$row_product['product_price'];
				$product_cat=$row_product['category_id'];
				echo "<div id='single_content'>
				<h3>$product_title</h3>
				
				<a href='details.php?pro_id=$product_id'><img src='admin_area/product_images/$product_img1' width='180' height='180'></img></a><br>
				<b>Price:Rs $product_price</b>
				<a href='details.php?pro_id=$product_id' style='float:left;'>Details</a>
				<a href='index.php?add_cart=$product_id'><button style='float:right;'>Add to Cart</button></a></div>";
			}
			
}
}


function getcat(){
	global $db;
	$get_cat="select * from categories";
				$run_cat=mysqli_query($db,$get_cat);
				while($row_cat=mysqli_fetch_array($run_cat))
                {
					$cat_id=$row_cat['cat_id'];
					$cat_title=$row_cat['cat_title'];
                echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>"; 
				}
}
	
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
 	
		
function cart()
{
	global $db;
	if(isset($_GET['add_cart']))
	{
		$ip=getIp();
		$p_id=$_GET['add_cart'];
		$cart_product="select * from cart where p_id='$p_id' AND ip_add='$ip'";
		$chck_cart=mysqli_query($db,$cart_product);
		if(mysqli_num_rows($chck_cart)==0)
		{
			$insert_cart="insert into cart(p_id,ip_add,p_qty) values('$p_id','$ip','1')";
			$run_cart=mysqli_query($db,$insert_cart);
			echo "<script>window.open('index.php','_self')</script>";
		}
		else
		{
			$update_cart="update cart set p_qty=p_qty+1 where p_id='$p_id' and  ip_add='$ip' ";
			$run_cart=mysqli_query($db,$update_cart);
			echo "<script>window.open('index.php','_self')</script>";
		}
	}
}
function tot_items()
{
	global $db;
	$ip=getIp();
	$cart_product="select * from cart where ip_add='$ip'";
	$chck_cart=mysqli_query($db,$cart_product);
	$count=mysqli_num_rows($chck_cart);
	echo $count;
}

function tot_price()
{
	global $db;
	$ip=getIp();
	$total=0;
	$cart_product="select * from cart where ip_add='$ip'";
	$check_cart=mysqli_query($db,$cart_product);
	while($row_cart=mysqli_fetch_array($check_cart))
                {
					$p_id=$row_cart['p_id'];
					$p_qty=$row_cart['p_qty'];
                	$cart_product1="select * from products where product_id='$p_id'";
					$check_cart1=mysqli_query($db,$cart_product1);
					while($row_cart1=mysqli_fetch_array($check_cart1))
               		{
					$p_price=$row_cart1['product_price'];
				     }
					 $total=$total+($p_qty*$p_price);
				}
				echo $total;
}
?>