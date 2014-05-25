<!-- Fancy Box Scripts -->

<link href="fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="inc/jquery.easing.1.3.js"></script>
<script src="fancybox/jquery.fancybox-1.3.4.min.js"></script>

<script>
$(document).ready(function() {
	$('#gallery a').fancybox({
		overlayColor: '#060',
		overlayOpacity: .3,
		transitionIn: 'elastic',
		transitionOut: 'elastic',
		easingIn: 'easeInSine',
		easingOut: 'easeOutSine',
		titlePosition: 'outside' ,		
		cyclic: true
	});
}); // end ready
</script>

<!-- End of Fancy Box Scripts -->




<?php
// So image titles display with full absolute URLs:
 include("client.php");
?>






<?php // 
/* This script lists the directories and files in an images directory. */

$images = "images/";


// Set the time zone:
date_default_timezone_set('Australia/Brisbane');


// Set the directory name and scan it:
$search_dir = 'images';
$contents = scandir($search_dir);


// List the directories first...
// Print a caption and start a list:
print '
<ul>';
foreach ($contents as $item) {
	if ( (is_dir($search_dir . '/' . $item)) AND (substr($item, 0, 1) != '.') ) {
		print "<li>$item</li>\n";
	}
}

print '</ul>'; // Close the list.



// Create Fancy Box gallery div:
print '<hr/><h2>Images Library</h2>
<div class="wrapper"><div class="content"><div class="main"><div id="gallery">';



// List the files:
foreach ($contents as $item) {
	if ( (is_file($search_dir . '/' . $item)) AND (substr($item, 0, 1) != '.') ) {
	
		// Get the file size:
		$fs = filesize($search_dir . '/' . $item);

		// Get the file's modification date:
		$lm = date('F j, Y', filemtime($search_dir . '/' . $item));

		// Print the information:
		print "<a href=\"$client$images$item\" rel=\"gallery\" title=\"$client$images$item\">$client$images$item</a><br/><br/>";
	
	} // Close the IF.

} // Close the FOREACH.


print '</div></div></div></div><hr/>'; // Close the Fancy Box gallery divs.

?>

