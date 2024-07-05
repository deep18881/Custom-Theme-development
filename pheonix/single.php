<?php
/**
 * Single Post Template File
 *
 * @package Pheonix
 */

// Get header template.
get_header();
// Main content wrapper.
?>
<div id="primary">
	<!-- Main content area -->
	<main id="main" class="site-main mt-5" role="main">
		<?php
		// Check if there are posts.
		if ( have_posts() ) {
			// Loop through posts.
			?>
			<div class="container">
				<?php
				// Check if is home page.
				if ( is_home() && ! is_front_page() ) {
					// Display post title using get post title in header html tag.
					?>
					<header class="page-header mb-5">
						<h1 class="page-title scree-reader-text">
							<?php
							// Get singe post title.
							single_post_title();
							?>
						</h1>
					</header>
					<?php
				}

				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content-display' );
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

