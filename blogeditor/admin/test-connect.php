<!DOCTYPE html>
<html>
<head>
<?php include("inc/stylesheet.php"); ?>

<Title>
<?php include("inc/page-index.php"); ?>
</Title>

<?php include("inc/head.php"); ?>
</head>

<body>

<?php include("inc/background-image.php"); ?>

<div id="container">
<?php include("inc/header.php"); ?>



<div id="content">


<?php
$db_username = "xxxx"; 
$db_password = "xxxx"; 
$db_hostname = "xxxx";     
$db_connect = mysql_connect($db_hostname, $db_username, $db_password)or die("Unable to connect to MySQL"); 
//  additional functionality here 
echo "You have successfully connected to MySQL!"; 
mysql_close($db_connect); 
?>



</div>


</div>

</body>
</html>