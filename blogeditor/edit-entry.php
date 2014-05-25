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
/* This script edits a blog entry using an UPDATE query. */

include("admin/mysql-connect.php");


if (isset($_GET['id']) && is_numeric($_GET['id']) ) { // Display the entry in a form:

	// Define the query.
	$query = "SELECT title, entry, category, author, description, keywords FROM blog WHERE entry_id={$_GET['id']}";
	if ($r = mysql_query($query, $dbc)) { // Run the query.
	
		$row = mysql_fetch_array($r); // Retrieve the information.
		
		// Make the form:
		print '<form action="edit-entry.php" method="post">
	<p align="center">Entry Title: <br/><input type="text" name="title" size="40" maxsize="100" value="' . htmlentities($row['title']) . '" /></p>
	<p align="center">Entry Text: <br/><textarea name="entry" cols="100" rows="50">' . htmlentities($row['entry']) . '</textarea><script>CKEDITOR.replace( "entry" );</script></p>
	<p align="center">Entry Category: <br/><input type="text" name="category" size="20" maxsize="20" value="' . htmlentities($row['category']) . '"  /></p>
	<p align="center">Entry Author: <br/><input type="text" name="author" size="20" maxsize="20" value="' . htmlentities($row['author']) . '"  /></p>
	<p align="center">Description: <br/><textarea name="description" cols="90" rows="5">' . htmlentities($row['description']) . '</textarea></p>
	<p align="center">Keywords: <br/><input type="text" name="keywords" size="100" maxsize="200" value="' . htmlentities($row['keywords']) . '"  /></p>
	<p align="center"><input type="hidden" name="id" value="' . $_GET['id'] . '" /></p>
	<p align="center"><input type="submit" name="submit" value="Update this Entry!" /></p>
	</form>';

	} else { // Couldn't get the information.
		print '<p style="color: red;">Could not retrieve the blog entry because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	}

} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) { // Handle the form.

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

		// Define the query.
		$query = "UPDATE blog SET title='$title', entry='$entry', category='$category', author='$author', description='$description', keywords='$keywords' WHERE entry_id={$_POST['id']}";
		$r = mysql_query($query, $dbc); // Execute the query.
		
		// Report on the result:
		if (mysql_affected_rows($dbc) == 1) {
			print '<p align="center"><font color="red">The blog entry has been updated.</font></p>';
			header( 'Location: view-entries.php?result=2' );
		} else {
			print '<p style="color: red;">Could not update the entry because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
		}
		
	} // No problem!

} else { // No ID set.
	print '<p style="color: red;">This page has been accessed in error.</p>';
} // End of main IF.

mysql_close($dbc); // Close the connection.

?>


<?php include("inc/plugin02.php"); ?>
</div>

<?php include("inc/sidebar-right.php"); ?>
<?php include("inc/footer.php"); ?>
</div>

</body>
</html>
<?php ob_end_flush(); ?>