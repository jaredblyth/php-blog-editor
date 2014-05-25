<?php ob_start(); ?>

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







<?php //
/* This is the logout page. It destroys the cookie. */

// Destroy the cookie, but only if it already exists:
if (isset($_COOKIE['Barack'])) {
	setcookie('Barack', FALSE, time()-300);
}


// Print a message:
echo '<p align="center" id="loggedoutstatus">You are now logged out.</p>';

?>





</div>

</body>
</html>

<?php ob_end_flush(); ?>