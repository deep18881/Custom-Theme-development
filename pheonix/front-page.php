<?php
/**
 * Front page template
 *
 * @package Pheonix
 */

get_header();
?>
<div id="primary">
	<!-- Main content area -->
	<main id="main" class="site-main mt-5" role="main">
		<?php
		// Check if there are posts.
		if ( have_posts() ) {
			// Loop through posts.
			?>
			<div class="home-page-wrap">
			<!-- <div class="container"> -->
				<?php
				while ( have_posts() ) {
					the_post();
					// Get template part.
					get_template_part( 'template-parts/content', 'page' );
				}
				?>
			</div>
			<?php
		} else {
			// Display message if there are no posts.
			get_template_part( 'template-parts/content', 'none' );
		}
		// Get footer template.
		get_footer();
