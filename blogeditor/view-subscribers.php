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
/* This script retrieves subscribers from the subscribers database. */

// This page may be loaded as a redirect after successfully adding a new subscriber, updating an subscriber or deleting an subscriber. In that case the URL will contain a number which the below code will retrieve using the HTTP GET method. If there is no number because it is the first time the user has visited this page (i.e. hasn't try to add, update or delete a subscriber) then no message is displayed:

	if (isset($_GET['result'])  && ($_GET['result'] == 1)) {print "<p id=\"lblStatus\" >Your subscriber was successfully added to the database</p>";}

	if (isset($_GET['result'])  && ($_GET['result'] == 2)) {print "<p id=\"lblStatus\" >Your subscriber was successfully updated in the database</p>";}

	if (isset($_GET['result'])  && ($_GET['result'] == 3)) {print "<p id=\"lblStatus\" >Your subscriber was successfully deleted from the database</p>";}




// Start of standard section of page:

include("admin/mysql-connect.php");


	


// Define the query:
$query = 'SELECT * FROM subscribers ORDER BY date_registered ASC';
	
if ($r = mysql_query($query, $dbc)) { // Run the query.

print "<b>Subscribers</b><p><table>";

	// Retrieve and print every record:
	while ($row = mysql_fetch_array($r)) {
		print "<tr><td>{$row['subscriber_id']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</td><td>{$row['subscriber_email']}</td><td>{$row['subscriber_age']}</td><td>{$row['subscriber_sex']}</td><td>{$row['subscriber_location']}</td><td><a href=\"delete-subscriber.php?id={$row['subscriber_id']}\">Delete</a></td></tr>";
	}

print "</table>";


} else { // Query didn't run.
	print '<p style="color: red;">Could not retrieve the data because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
} // End of query IF.






// Define the query:
$query = 'SELECT * FROM members ORDER BY date_registered ASC';
	
if ($r = mysql_query($query, $dbc)) { // Run the query.

print "<p><p><b>Members</b><p><table>";

	// Retrieve and print every record:
	while ($row = mysql_fetch_array($r)) {
		print "<tr><td>{$row['member_id']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</td><td>{$row['member_email']}</td><td>{$row['member_age']}</td><td>{$row['member_sex']}</td><td>{$row['member_location']}</td><td><a href=\"delete-member.php?id={$row['member_id']}\">Delete</a></td></tr>";
	}

print "</table>";


} else { // Query didn't run.
	print '<p style="color: red;">Could not retrieve the data because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
} // End of query IF.



mysql_close($dbc); // Close the connection.

?>


<?php include("inc/plugin02.php"); ?>
</div>

<?php include("inc/sidebar-right.php"); ?>
<?php include("inc/footer.php"); ?>
</div>

</body>
</html>