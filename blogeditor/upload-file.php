<?php include("admin/functions.php"); ?>
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
<?php include("inc/widemenu.php"); ?>
<?php include("inc/sidebar-left.php"); ?>


<div id="content">
<?php include("inc/plugin01.php"); ?>


<?php //
/* This script displays and handles an HTML form. This script takes a file upload and stores it on the server. */

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Try to move the uploaded file:
	if (move_uploaded_file ($_FILES['the_file']['tmp_name'], "images/{$_FILES['the_file']['name']}")) {
	
		print '<p>Your file has been uploaded.</p>';
	
	} else { // Problem!

		print '<p style="color: red;">Your file could not be uploaded because: ';
		
		// Print a message based upon the error:
		switch ($_FILES['the_file']['error']) {
			case 1:
				print 'The file exceeds the upload_max_filesize setting in php.ini';
				break;
			case 2:
				print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form';
				break;
			case 3:
				print 'The file was only partially uploaded';
				break;
			case 4:
				print 'No file was uploaded';
				break;
			case 6:
				print 'The temporary folder does not exist.';
				break;
			default:
				print 'Something unforeseen happened.';
				break;
		}
		
		print '.</p>'; // Complete the paragraph.

	} // End of move_uploaded_file() IF.
	
} // End of submission IF.

// Leave PHP and display the form:
?>

<form action="upload-file.php" enctype="multipart/form-data" method="post">
	<p>Upload a file:</p>
	<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
	<p><input type="file" name="the_file" /></p>
	<p><input type="submit" name="submit" value="Upload This File" /></p>
</form>





<?php
// So image titles display with full absolute URLs:
 include("inc/client.php");

// Show images:
 include("inc/images-library.php");
?>


<?php include("inc/plugin02.php"); ?>
</div>

<?php include("inc/sidebar-right.php"); ?>
<?php include("inc/footer.php"); ?>
</div>

</body>
</html>