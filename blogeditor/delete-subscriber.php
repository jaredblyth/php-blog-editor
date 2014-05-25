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
/* This script deletes a blog subscriber. */

include("admin/mysql-connect.php");
	
if (isset($_GET['id']) && is_numeric($_GET['id']) ) { // Display the subscriber in a form:

	// Define the query:
	$query = "SELECT subscriber_email FROM subscribers WHERE subscriber_id={$_GET['id']}";
	if ($r = mysql_query($query, $dbc)) { // Run the query.
	
		$row = mysql_fetch_array($r); // Retrieve the information.

		// Make the form:
		print '<form action="delete-subscriber.php" method="post">
		<p align="center"><h2><font color="red">Are you sure you want to delete this subscriber?</font></h2></p>
		<p align="center"><h3>' . $row['subscriber_email'] . '</h3><br />
		<p align="center"><input type="hidden" name="id" value="' . $_GET['id'] . '" />
		<p align="center"><input type="submit" name="submit" value="Delete this subscriber!" /></p>
		</form>';

	} else { // Couldn't get the information.
		print '<p style="color: red;">Could not retrieve the blog subscriber because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	}

} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) { // Handle the form.
	
	// Define the query:
	$query = "DELETE FROM subscribers WHERE subscriber_id={$_POST['id']} LIMIT 1";
	$r = mysql_query($query, $dbc); // Execute the query.
	
	// Report on the result:
	if (mysql_affected_rows($dbc) == 1) {
		print '<p align="center"><font color="red">The blog subscriber has been deleted.</font></p>';
		header( 'Location: view-subscribers.php?result=3' );
	} else {
		print '<p style="color: red;">Could not delete the blog subscriber because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	}

} else { // No ID received.
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