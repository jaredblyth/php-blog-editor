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


<div id="leftbox" style="width:50%; float:left; font-size:10px;">

<?php


include("admin/mysql-connect.php");

	
// Define the query to display most recent entries:
$query =  'SELECT entry_id, title FROM blog ORDER BY date_entered DESC LIMIT 30';
	
if ($r = mysql_query($query, $dbc)) { // Run the query.

	// Retrieve and print every record:
	while ($row = mysql_fetch_array($r)) {
		print "<font color=\"red\">{$row['entry_id']}</font> - {$row['title']}<hr/>";
	}

} else { // Query didn't run.
	print '<p style="color: red;">Could not retrieve the data because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
} // End of query IF.

mysql_close($dbc); // Close the connection.

?>

</div>



<div id="rightbox" style="width:40%; float:right;">

<!-- Create a URL using JQuery from the numbers entered into the form. The script at newsletter.php will GET these values -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

<script>
$(document).ready(function() {

    $("#enter").click(function() {
        window.location = "newsletter.php?a=" + $("#a").val() + "&b=" + $("#b").val() + "&c=" + $("#c").val() + "&d=" + $("#d").val() + "&e=" + $("#e").val() + "&i=" + $("#i").val() + "&s=" + $("#s").val() + "&z=" + $("#z").val();
    });                          

});
</script>


<h3>Enter the ID numbers of the articles you wish to show in the newsletter</h3>

<form id="form1">

Include Intro:
<select id="i">

<option value="9">Yes</option>

<option value="0">No</option>


</select>

<a href="newsletter-intro-edit.php" onclick="javascript:void window.open('newsletter-intro-edit.php','1364010933399','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;">Edit</a>


<br/><br/>


1st: <input type="text" id="a" /><br/><br/>
2nd: <input type="text" id="b" /><br/><br/>
3rd: <input type="text" id="c" /><br/><br/>
4th: <input type="text" id="d" /><br/><br/>
5th: <input type="text" id="e" /><br/><br/>

Include Signature:
<select id="s">

<option value="9">Yes</option>

<option value="0">No</option>


</select>

<a href="newsletter-signature-edit.php" onclick="javascript:void window.open('newsletter-signature-edit.php','1364010933399','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;">Edit</a>

<br/><br/>


Length:<input type="text" id="z" value="10000"/><br/><br/>

<input type="button" value="Create Newsletter" id="enter"/>
</form>

</div>

<?php include("inc/plugin02.php"); ?>
</div>

<?php include("inc/sidebar-right.php"); ?>
<?php include("inc/footer.php"); ?>
</div>

</body>
</html>