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
/* This script lists the directories and files in a directory. */

// Set the time zone:
date_default_timezone_set('Australia/Brisbane');

// Set the directory name and scan it:
$search_dir = '.';
$contents = scandir($search_dir);

// List the directories first...
// Print a caption and start a list:
print '<h2>Directories</h2>
<ul>';
foreach ($contents as $item) {
	if ( (is_dir($search_dir . '/' . $item)) AND (substr($item, 0, 1) != '.') ) {
		print "<li>$item</li>\n";
	}
}

print '</ul>'; // Close the list.

// Create a table header:
print '<hr /><h2>Files</h2>
<table cellpadding="2" cellspacing="2" align="left">
<tr>
<td>Name</td>
<td>Size</td>
<td>Last Modified</td>
</tr>';

// List the files:
foreach ($contents as $item) {
	if ( (is_file($search_dir . '/' . $item)) AND (substr($item, 0, 1) != '.') ) {
	
		// Get the file size:
		$fs = filesize($search_dir . '/' . $item);

		// Get the file's modification date:
		$lm = date('F j, Y', filemtime($search_dir . '/' . $item));

		// Print the information:
		print "<tr>
		<td>$item</td>
		<td>$fs bytes</td>
		<td>$lm</td>
		</tr>\n";
	
	} // Close the IF.

} // Close the FOREACH.

print '</table>'; // Close the HTML table.

?>


<?php include("inc/plugin02.php"); ?>
</div>

<?php include("inc/sidebar-right.php"); ?>
<?php include("inc/footer.php"); ?>
</div>

</body>
</html>