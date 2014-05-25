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
/* This script edits a blog comment using an UPDATE query. */

include("admin/mysql-connect.php");


if (isset($_GET['id']) && is_numeric($_GET['id']) ) { // Display the comment in a form:

	// Define the query.
	$query = "SELECT * FROM blog_comments WHERE comment_id={$_GET['id']}";
	if ($r = mysql_query($query, $dbc)) { // Run the query.
	
		$row = mysql_fetch_array($r); // Retrieve the information.
		
		// Make the form:
		print '<form action="edit-comment.php" method="post">
	<p align="center">First Name: <br/><input type="text" name="first_name" size="40" maxsize="100" value="' . htmlentities($row['comment_first_name']) . '" /></p>
	<p align="center">Last Name: <br/><input type="text" name="last_name" size="40" maxsize="100" value="' . htmlentities($row['comment_last_name']) . '" /></p>
	<p align="center">Email: <br/><input type="text" name="email" size="40" maxsize="40" value="' . htmlentities($row['comment_email']) . '"  /></p>
	<p align="center">comment: <br/><input type="text" name="comment" value="' . htmlentities($row['comment']) . '"  /></p>
	<p align="center">Blog ID: <br/><input type="text" name="blog_id" size="20" maxsize="20" value="' . htmlentities($row['comment_blog_id']) . '"  /></p>
	<p align="center">Comment Approved: <br/><input type="text" name="comment_approved" size="10" maxsize="10" value="' . htmlentities($row['comment_approved']) . '"  /></p>
	<p align="center"><input type="hidden" name="id" value="' . $_GET['id'] . '" /></p>
	<p align="center"><input type="submit" name="submit" value="Update this comment!" /></p>
	</form>';

	} else { // Couldn't get the information.
		print '<p style="color: red;">Could not retrieve the blog comment because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	}


} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) { // Handle the form.

// Process the comment form and prepare for inserting into blog_comments database:
		$first_name = mysql_real_escape_string(trim(strip_tags($_POST['first_name'])), $dbc);
		$last_name = mysql_real_escape_string(trim(strip_tags($_POST['last_name'])), $dbc);
		$email = mysql_real_escape_string(trim(strip_tags($_POST['email'])), $dbc);
		$comment = mysql_real_escape_string(trim(strip_tags($_POST['comment'])), $dbc);
		$blog_id = mysql_real_escape_string(trim(strip_tags($_POST['blog_id'])), $dbc);
		$comment_approved = mysql_real_escape_string(trim(strip_tags($_POST['comment_approved'])), $dbc);
		$previous_page = $_POST['current_page'];



		// Define the query:
		$query = "UPDATE blog_comments SET comment_first_name='$first_name', comment_last_name='$last_name', comment_email='$email', comment='$comment', comment_blog_id='$blog_id', comment_approved='$comment_approved' WHERE comment_id={$_POST['id']}";
		
		// Execute the query:
		if (@mysql_query($query, $dbc)) {
			header( 'Location: view-comments.php?result=2' );
		} else {
			print '<p style="color: red;">Could not add the comment because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
		}


	mysql_close($dbc); // Close the connection.
	
	
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