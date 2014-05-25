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

<h1>Comments</h1>

<?php //  
/* This script retrieves blog comments from the blog_comments database. */

// This page may be loaded as a redirect after successfully adding a new comment, updating an comment or deleting an comment. In that case the URL will contain a number which the below code will retrieve using the HTTP GET method. If there is no number because it is the first time the user has visited this page (i.e. hasn't try to add, update or delete a comment) then no message is displayed:

	if (isset($_GET['result'])  && ($_GET['result'] == 1)) {print "<p id=\"lblStatus\" >Your comment was successfully added to the database</p>";}

	if (isset($_GET['result'])  && ($_GET['result'] == 2)) {print "<p id=\"lblStatus\" >Your comment was successfully updated in the database</p>";}

	if (isset($_GET['result'])  && ($_GET['result'] == 3)) {print "<p id=\"lblStatus\" >Your comment was successfully deleted from the database</p>";}




// Start of standard section of page:

include("admin/mysql-connect.php");
include("inc/client.php"); //Required to build comment_blog_id link:

	
// Define the query:
$query = 'SELECT * FROM blog_comments ORDER BY comment_date DESC';
	
if ($r = mysql_query($query, $dbc)) { // Run the query.

	// Retrieve and print every record:
	while ($row = mysql_fetch_array($r)) {
		print "<p>{$row['comment']}</p>

<p>

		From: {$row['comment_first_name']} {$row['comment_last_name']}, {$row['comment_email']} on {$row['comment_date']} about blog post#<a href=\"";

		print $client2;

		print "/page.php?id={$row['comment_blog_id']}\" target=\"_blank\">{$row['comment_blog_id']}</a>, <font color=\"red\">Approved = {$row['comment_approved']}</font>

		<a href=\"edit-comment.php?id={$row['comment_id']}\">Edit</a>&nbsp&nbsp
		<a href=\"delete-comment.php?id={$row['comment_id']}\">Delete</a>

		<hr />\n";
	}

} else { // Query didn't run.
	print '<p style="color: red;">Could not retrieve the data because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
} // End of query IF.

mysql_close($dbc); // Close the connection.

?>

<p align="center">
<a href="add-comment.php">Add a comment</a></p>

<?php include("inc/plugin02.php"); ?>
</div>

<?php include("inc/sidebar-right.php"); ?>
<?php include("inc/footer.php"); ?>
</div>

</body>
</html>