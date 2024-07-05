<?php
/**
 * Template for post entry meta.
 *
 * @package Pheonix
 */

?>

<div class="entry-meta mb-3">
	<?php
	// Display post date.
	get_the_post_published_date_and_time();
	// Display post author.
	get_the_post_author();
	?>
</div>  
