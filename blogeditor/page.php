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
/* This script retrieves single blog entry from the database. */

include("admin/mysql-connect.php");

if (isset($_GET['id']) && is_numeric($_GET['id']) ) { // Display the entry in a form:

	// Define the query.
	$query = "SELECT title, entry, category, author FROM blog WHERE entry_id={$_GET['id']}";
	if ($r = mysql_query($query, $dbc)) { // Run the query.
	
		$row = mysql_fetch_array($r); // Retrieve the information.
		
		// Make the form:
		echo 
'<h1>';
		echo 
$row['title'];
		echo 
'</h1>';
		echo 
'<a href="edit-entry.php?id=';
		echo 
$_GET['id'];
		echo 
'">Edit</a>&nbsp&nbsp';
		echo 
'<a href="delete-entry.php?id=';
		echo 
$_GET['id'];
		echo 
'">Delete</a>';
		echo

'<br/><br/>By: ';
		echo 
$row['author'];
		echo 
'<p>Posted in: ';
		echo 
$row['category'];
		echo 
'<p>';
		echo 
$row['entry'];
		echo 
'<p>';




	} else { // Couldn't get the information.
		print '<p style="color: red;">Could not retrieve the blog entry because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	}

} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) { // Handle the form.

	// Validate and secure the form data:
	$problem = FALSE;
	if (!empty($_POST['title']) && !empty($_POST['entry'])) {
		$title = mysql_real_escape_string(trim(strip_tags($_POST['title'])), $dbc);
		$entry = mysql_real_escape_string(trim(strip_tags($_POST['entry'], '<p><strong><em><b><i><a><img>')), $dbc);
	} else {
		print '<p style="color: red;">Please submit both a title and an entry.</p>';
		$problem = TRUE;
	}

	if (!$problem) {

		// Define the query.
		$query = "UPDATE entries SET title='$title', entry='$entry' WHERE entry_id={$_POST['id']}";
		$r = mysql_query($query, $dbc); // Execute the query.
		
		// Report on the result:
		if (mysql_affected_rows($dbc) == 1) {
			print '<p>The blog entry has been updated.</p>';
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