<?php
include("includes/db.php")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
 <!--><script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script><!-->
</head>
<body bgcolor="#9999FF">
<form method="post" action="insert_product.php" enctype="multipart/form-data">
<table width="800" align="center" \ border="2" bgcolor="#0066CC">
<tr align="center">
<td colspan="2"><h2>Insert New Product:</h2></td>
</tr>
<tr>
<td align="center"><b>Product Title</b></td>
<td><input type="text" name="product_title" size="50" /></td>
</tr>
<tr>
<td align="center"><b>Product Category</b></td>
<td>
<select name="product_cat">
	<option>Select a category:</option>
    <?php
    $get_cat="select * from categories";
				$run_cat=mysqli_query($con,$get_cat);
				while($row_cat=mysqli_fetch_array($run_cat))
                {
					$cat_id=$row_cat['cat_id'];
					$cat_title=$row_cat['cat_title'];
                echo "<option value='$cat_id'>$cat_title</option>"; 
				}
	?>
</td>
</tr>
<tr>
<td align="center"><b>Product Image1</b></td>
<td><input type="file" name="product_img1"  /></td>
</tr>
<tr>
<td align="center"><b>Product Image2</b></td>
<td><input type="file" name="product_img2"  /></td>
</tr>
<tr>
<td align="center"><b>Product Image3</b></td>
<td><input type="file" name="product_img3"  /></td>
</tr>
<tr>
<td align="center"><b>Product Price</b></td>
<td><input type="text" name="product_price"  /></td>
</tr>
<tr>
<td align="center"><b>Product Quantity</b></td>
<td><input type="text" name="product_qty"  /></td>
</tr>
<tr>
<td align="center"><b>Product Description</b></td>
<td><textarea name="product_desc" cols="20" rows="8"></textarea></td>
</tr>
<tr>
<td align="center"><b>Product Keywords</b></td>
<td><input type="text" name="product_keywords" size="50"  /></td>
</tr>
<tr align="center">
<td colspan="2"><input type="submit" name="submit"  value="Submit" /></td>
</tr>
</table>
</form>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
$product_title=$_POST['product_title'];	
$product_cat=$_POST['product_cat'];	
$product_price=$_POST['product_price'];	
$product_desc=$_POST['product_desc'];	
$product_qty=$_POST['product_qty'];	
$product_keywords=$_POST['product_keywords'];

$product_img1=$_FILES['product_img1']['name'];	
$product_img2=$_FILES['product_img2']['name'];	
$product_img3=$_FILES['product_img3']['name'];	

$temp_product_img1=$_FILES['product_img1']['tmp_name'];	
$temp_product_img2=$_FILES['product_img2']['tmp_name'];	
$temp_product_img3=$_FILES['product_img3']['tmp_name'];	

if($product_title=='' or $product_cat=='' or $product_desc=='' or $product_img1=='' or $product_keywords=='' or $product_price=='' or $product_qty=='')
{
	echo "<script>alert('Please fill all the fields..!!!!')</script>";
	exit();
}
else
{
	move_uploaded_file($temp_product_img1,"product_images/$product_img1");
	move_uploaded_file($temp_product_img2,"product_images/$product_img2");
	move_uploaded_file($temp_product_img3,"product_images/$product_img3");
	
	$insert_product="insert into products(category_id,product_title,product_img1,product_img2,product_img3,product_desc,product_price,product_qty,product_keyword) values('$product_cat','$product_title','$product_img1','$product_img2','$product_img3','$product_desc','$product_price','$product_qty','$product_keywords')";
	
	$run_product=mysqli_query($con,$insert_product);
	if($run_product)
	{
		echo "<script>alert('Product inserted successfully....')</script>";
	}
}
	
}
?>