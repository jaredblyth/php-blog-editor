<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Add An Intro</title>
<script src="ckeditor/ckeditor.js"></script>
</head>
<body>

<?php // 
/* This script displays and handles an HTML form. This script takes text input and stores it in a text file. */


// Identify the file to use:
$file = 'newsletter-intro.php';


// Check for a form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	if ( !empty($_POST['entry']) && ($_POST['entry'] != 'Enter your text here.') ) { // Need some thing to write.
	
		if (is_writable($file)) { // Confirm that the file is writable.
			
			file_put_contents($file, $_POST['entry'] . PHP_EOL); // Write the data. Have currently removed , FILE_APPEND | LOCK_EX as third arguments in the brackets. This means previous contents will be overwritten.

			// Print a message:
			print '<p>Your newsletter introduction has been stored.</p>';
		
		} else { // Could not open the file.
			print '<p style="color: red;">Your text could not be stored due to a system error.</p>';
		}
		
	} else { // Failed to enter some text.
		print '<p style="color: red;">Please enter some text!</p>';
	}
	
} // End of submitted IF.

// Leave PHP and display the form:
?>


<h3>Your current introduction looks like this in HTML:</h3>

<?php include('newsletter-intro.php'); ?>

<br/><br/>

Edit your intro below:<br/><br/>

<form action="newsletter-intro-edit.php" method="post">
	<textarea name="entry" rows="5" cols="80"><?php include('newsletter-intro.php'); ?></textarea><script>CKEDITOR.replace( 'entry' );</script><br />
	<input type="submit" name="submit" value="Add As Intro!" />
</form>

</body>
</html>
