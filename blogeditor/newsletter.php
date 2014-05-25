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
/* This script retrieves blog entries from the database based on the following formulas. */

// Retrieve variables from URL and check that they exist and have a numerical value:

if (isset($_GET['a']) && is_numeric($_GET['a']) ) {$a=$_GET['a'];} else{$a=0;} //Variable for 1st article:
if (isset($_GET['b']) && is_numeric($_GET['b']) ) {$b=$_GET['b'];} else{$b=0;} //Variable for 2nd article:
if (isset($_GET['c']) && is_numeric($_GET['c']) ) {$c=$_GET['c'];} else{$c=0;} //Variable for 3rd article:
if (isset($_GET['d']) && is_numeric($_GET['d']) ) {$d=$_GET['d'];} else{$d=0;} //Variable for 4th article:
if (isset($_GET['e']) && is_numeric($_GET['e']) ) {$e=$_GET['e'];} else{$e=0;} //Variable for 5th article:

if (isset($_GET['i']) && is_numeric($_GET['i']) ) {$i=$_GET['i'];} else{$i=0;} //Variable to include intro:
if (isset($_GET['s']) && is_numeric($_GET['s']) ) {$s=$_GET['s'];} else{$s=0;} //Variable to include signature:


//Retrieve variable from URL to set length of characters returned in the entry (to nearest word / > but note that tags may still be left open) - also note the default value:
if (isset($_GET['z']) && is_numeric($_GET['z']) ) {$z=$_GET['z'];} else{$z=800;}


// Build query string to determine which blog entries to show in the newsletter from those variables (a-e) that are set in the URL:

if ($a > 1 ){$part1="$a";} else{$part1="";}
if ($b > 1 ){$part2=" OR entry_id=$b";} else{$part2="";}
if ($c > 1 ){$part3=" OR entry_id=$c";} else{$part3="";}
if ($d > 1 ){$part4=" OR entry_id=$d";} else{$part4="";}
if ($e > 1 ){$part5=" OR entry_id=$e";} else{$part5="";}


// Create a variable to display the entries in the set order (otherwise will default to order ascending):

$order = '"'.$a.','.$b.','.$c.','.$d.','.$e.'"';


// The completed query string:

$newsletter = 'SELECT entry_id, title, entry FROM blog WHERE entry_id='.$part1.$part2.$part3.$part4.$part5.' ORDER BY FIND_IN_SET(entry_id, '.$order.')';


//First include the introduction if selected:

if ($i > 1 ){include('newsletter-intro.php');} else{print "";}



//Now connect to database to retrieve the blog entries:

include("admin/mysql-connect.php");

include("inc/client.php"); //Required to build correct hyperlinks from newsletter to public blog - uses variable of $client2 below:

	
// Define the query to retrieve the blog entries:
$query = $newsletter;
	
if ($r = mysql_query($query, $dbc)) { // Run the query.

	// Retrieve and print every record:
	while ($row = mysql_fetch_array($r)) {
		print "<div><a href=\"";

		print $client2;

		print "/page.php?id={$row['entry_id']}&src=edm\"><h3>{$row['title']}</h3></a>";

		print $row['entry'];

		print "</div><div><a href=\"";

		print $client2;

		print "/page.php?id={$row['entry_id']}&src=edm\"><strong>Read More...</strong></a>

		</div>\n";
	}

} else { // Query didn't run.
	print '<p style="color: red;">Could not retrieve the data because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
} // End of query IF.

mysql_close($dbc); // Close the connection.


print "<br/><br/>";

//Finally include the signature if selected:

if ($s > 1 ){include('newsletter-signature.php');} else{print "";}

?>


<?php include("inc/plugin02.php"); ?>
</div>

<?php include("inc/sidebar-right.php"); ?>
<?php include("inc/footer.php"); ?>
</div>

</body>
</html>