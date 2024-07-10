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
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12">
				<?php
				// Check if there are posts.
				if ( have_posts() ) {
					// Loop through posts.
					?>
					<div class="post-wrap">
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
				} else {
					// Display message if there are no posts.
					get_template_part( 'template-parts/content', 'none' );
				}
				// include pagination.
				?>
				</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12">
					<?php
					// Displaying sidebar.
					get_sidebar();
					?>
				</div>
				<div class="container d-flex justify-content-center">
					<span class="page-links mr-1">
					<?php
					previous_post_link();
					?>
					</span>
					<span class="page-links ms-4">
					<?php
					next_post_link();
					?>
					</span>
			</div>
				</div>
			</div>
				<?php

				// Get footer template.
				get_footer();
