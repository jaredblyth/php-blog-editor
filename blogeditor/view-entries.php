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
/* This script retrieves blog entries from the database. */

// This page may be loaded as a redirect after successfully adding a new entry, updating an entry or deleting an entry. In that case the URL will contain a number which the below code will retrieve using the HTTP GET method. If there is no number because it is the first time the user has visited this page (i.e. hasn't try to add, update or delete an entry) then no message is displayed:

	if (isset($_GET['result'])  && ($_GET['result'] == 1)) {print "<p id=\"lblStatus\" >Your entry was successfully added to the database</p>";}

	if (isset($_GET['result'])  && ($_GET['result'] == 2)) {print "<p id=\"lblStatus\" >Your entry was successfully updated in the database</p>";}

	if (isset($_GET['result'])  && ($_GET['result'] == 3)) {print "<p id=\"lblStatus\" >Your entry was successfully deleted from the database</p>";}




// Start of standard section of page:

include("admin/mysql-connect.php");

	
// Define the query:
$query = 'SELECT * FROM blog ORDER BY date_entered DESC';
	
if ($r = mysql_query($query, $dbc)) { // Run the query.

	// Retrieve and print every record:
	while ($row = mysql_fetch_array($r)) {
		print "<p><a href=\"page.php?id={$row['entry_id']}\"><h3>{$row['title']}</h3></a>

<p align=\"center\">

		Posted in: {$row['category']}<p align=\"center\">


		<a href=\"edit-entry.php?id={$row['entry_id']}\">Edit</a>&nbsp&nbsp
		<a href=\"delete-entry.php?id={$row['entry_id']}\">Delete</a>

		</p><hr />\n";
	}

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