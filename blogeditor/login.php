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
/* This page lets people log into the site. */

//Retreive password information:
include("admin/password.php");


// Set two variables with default values:
$loggedin = false;
$error = false;

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Handle the form:
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
	
		if ( (strtolower($_POST['email']) == $username) && ($_POST['password'] == $password) ) { // Correct!
	
			// Create the cookie:
			setcookie('Barack', 'Obama', time()+7200);
			
			// Indicate they are logged in:
			$loggedin = true;
		
		} else { // Incorrect!

			$error = '<p align="center">The submitted email address and password do not match those on file!</p>';

		}

	} else { // Forgot a field.

		$error = '<p align="center">Please make sure you enter both an email address and a password!</p>';

	}

}



// Print an error if one exists:
if ($error) {
	print '<p class="error">' . $error . '</p>';
}

// Indicate the user is logged in, or show the form:
if ($loggedin) {
	
	print '<p align="center">You are now logged in!</p><p align="center">';
	header( 'Location: view-entries.php' );
	
} else {

	print '<div align="center"><h2>Login Form</h2>
	<form action="login.php" method="post">
	<p><label>Username <input type="text" name="email" /></label></p>
	<p><label>Password <input type="password" name="password" /></label></p>
	<p><input type="submit" name="submit" value="Log In!" /></p>
	</form></div>';

} 


?>






</div>

</body>
</html>

<?php ob_end_flush(); ?>