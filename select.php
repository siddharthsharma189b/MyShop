
<?php
$user='root';
$host='localhost';
$pass='';
$com=mysqli_connect($host,$user,$pass) or die ('Unable to connect to sql server<br>');
//function gethealth($health)
//{
//if($health>15000)
//{
//	$color='blue';
//}
//else if($health<15000)
//{
//	$color='red';
//}
//else
//{
//	$color='green';
//}
//return '<span style="color:'.$color.';">'.$health.'</span>';
//}
function details($user_id)
{
	global $com;
mysqli_select_db($com,'bank') or die(mysqli_error($com));
$sql= 'SELECT 
             *
       FROM
	          details';
$res=mysqli_query($com,$sql) or die('error');
while($row=mysqli_fetch_assoc($res))
{
	extract($row);
	if($cust_id==$user_id)
	{
echo '<div style="text-align:left;font-family: Castellar; font-size: 40px; color: red">Welcome  '.$cust_name.'<br><br>';
echo '<table border="2" cellspacing="2" cellpadding="2">';   
echo '<tr>';
echo '<td>Customer name:</td><td>'.$cust_name.'</td>';
echo '</tr>';
echo '<tr>';
echo '<td>Residence:</td><td>'.$cust_resd.'</td>';
echo '</tr>';
echo '<tr>';
echo '<td>Mobile No:</td><td>'.$cust_mob.'</td>';
echo '</tr>';
//echo '<tr>';
//echo '<td>Balance:</td><td>'.gethealth($cust_bal).' rupees</td>';
//echo '</tr>';
echo '</table>';   
	}
}
}
mysqli_select_db($com,'bank') or die(mysqli_error($com));
$sql= 'SELECT 
             *
       FROM
	          login';
$res=mysqli_query($com,$sql) or die('error');
while($row=mysqli_fetch_assoc($res))
{
	extract($row);
	if($user_id==$_POST['user'] && $user_pass==$_POST['pass'])
	{
		details($user_id);
		//exit();
	}
}
?>
<!DOCTYPE html>
<html>
<body>
<img src="login.jpg" width="300" height="100">
<div
   style="
    margin-top: 100px;
          text-align:center;
	  font-family: Cambria; font-size: 22px; color: red;
      visibility: show;">
<a href="index.php" style="color: rgb(255,100,100)">HOME_PAGE</a>
</div>
</body>
</html>