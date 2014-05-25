<?php ob_start(); ?>
<?php include("admin/functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
<?php include("inc/stylesheet.php"); ?>

<Title>
<?php include("inc/page-index.php"); ?>
</Title>

<?php include("inc/head.php"); ?>
<script src="ckeditor/ckeditor.js"></script>
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
/* This script adds a blog entry to the database securely! */

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.


include("admin/mysql-connect.php");
	
	// Validate and secure the form data:
	$problem = FALSE;
	if (!empty($_POST['title']) && !empty($_POST['entry'])) {
		$title = mysql_real_escape_string(trim(strip_tags($_POST['title'])), $dbc);
		$entry = mysql_real_escape_string(trim(strip_tags($_POST['entry'], '<p><strong><em><b><i><br><a><img><ul><li><table><tr><td><th><iframe><script><div><h1><h2><h3><span>')), $dbc);
		$category = mysql_real_escape_string(trim(strip_tags($_POST['category'])), $dbc);
		$author = mysql_real_escape_string(trim(strip_tags($_POST['author'])), $dbc);
		$description = mysql_real_escape_string(trim(strip_tags($_POST['description'])), $dbc);
		$keywords = mysql_real_escape_string(trim(strip_tags($_POST['keywords'])), $dbc);
	} else {
		print '<p style="color: red;">Please submit both a title and an entry.</p>';
		$problem = TRUE;
	}

	if (!$problem) {

		// Define the query:
		$query = "INSERT INTO blog (entry_id, title, entry, date_entered, category, author, description, keywords) VALUES (0, '$title', '$entry', NOW(), '$category', '$author', '$description', '$keywords')";
		
		// Execute the query:
		if (@mysql_query($query, $dbc)) {
			print '<p align="center"><font color="red">The blog entry has been added!</font></p>';
			header( 'Location: view-entries.php?result=1' );
		} else {
			print '<p style="color: red;">Could not add the entry because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
		}
	
	} // No problem!

	mysql_close($dbc); // Close the connection.
	
} // End of form submission IF.

// Display the form:
?>
<form action="add-entry.php" method="post">
	<p align="center">Entry Title: <br/><input type="text" name="title" size="40" maxsize="100" /></p>
	<p align="center">Entry Text: <br/><textarea name="entry" cols="100" rows="50"></textarea><script>CKEDITOR.replace( 'entry' );</script></p>
	<p align="center">Entry Category: <br/><input type="text" name="category" size="20" maxsize="20" /></p>
	<p align="center">Entry Author: <br/><input type="text" name="author" size="20" maxsize="20" /></p>
	<p align="center">Description: <br/><textarea name="description" cols="90" rows="5"></textarea></p>
	<p align="center">Keywords (separate by comma): <br/><input type="text" name="keywords" size="100" maxsize="200" /></p>
	<p align="center">
	<input type="submit" name="submit" value="Post This Entry!" />
</form>



<?php include("inc/plugin02.php"); ?>
</div>

<?php include("inc/sidebar-right.php"); ?>
<?php include("inc/footer.php"); ?>
</div>

</body>
</html>

<?php ob_end_flush(); ?>