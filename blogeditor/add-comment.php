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
/* This script adds a blog comment to the database securely! */

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.


include("admin/mysql-connect.php");

// Process the comment form and prepare for inserting into blog_comments database:
		$first_name = mysql_real_escape_string(trim(strip_tags($_POST['first_name'])), $dbc);
		$last_name = mysql_real_escape_string(trim(strip_tags($_POST['last_name'])), $dbc);
		$email = mysql_real_escape_string(trim(strip_tags($_POST['email'])), $dbc);
		$comment = mysql_real_escape_string(trim(strip_tags($_POST['comment'])), $dbc);
		$blog_id = mysql_real_escape_string(trim(strip_tags($_POST['blog_id'])), $dbc);
		$comment_approved = mysql_real_escape_string(trim(strip_tags($_POST['comment_approved'])), $dbc);
		$previous_page = $_POST['current_page'];



		// Define the query:
		$query = "INSERT INTO blog_comments (comment_id, comment_first_name, comment_last_name, comment_email, comment, comment_date, comment_blog_id, comment_approved) VALUES (0, '$first_name', '$last_name', '$email', '$comment', NOW(), '$blog_id', '$comment_approved')";
		
		// Execute the query:
		if (@mysql_query($query, $dbc)) {
			header( 'Location: view-comments.php?result=1' );
		} else {
			print '<p style="color: red;">Could not add the comment because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
		}


	mysql_close($dbc); // Close the connection.
	
	}
?>



<h3>Leave a comment</h3>

<form id="comments" name="comments" method="post" action="add-comment.php">

<P align="left">
<label>First Name:<br/>
        <input type="text" name="first_name" id="first_name" />
     </label>

<br/><br/>


<label>Last Name:<br/>
        <input type="text" name="last_name" id="last_name" />
     </label>
   
<br/><br/>

<label>Email address<br/>
        <input type="text" name="email" id="email" />
      </label>

<br/><br/>

<label>Your Comment<br />
        <textarea name="comment" id="comment" cols="50" rows="5" ></textarea>
     </label>



<br/><br/>


      <input type="hidden" name="blog_id" value="<?php echo $id; ?>" />
      <input type="hidden" name="comment_approved" value="No"/>
      <input type="hidden" name="current_page" value=""/>


<input type="submit" name="submit" id="submit" value="Send"  />

</form>


<?php include("inc/plugin02.php"); ?>
</div>

<?php include("inc/sidebar-right.php"); ?>
<?php include("inc/footer.php"); ?>
</div>

</body>
</html>
<?php ob_end_flush(); ?>