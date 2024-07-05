<?php
/**
 * Template for post entry content.
 *
 * @package Pheonix
 */

?>
<div class="entry-content">
	<?php
	if ( is_single() ) {
		the_content();
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers. */
				__( 'Continue reading %s<span class="screen-reader-text meta-nav">&rarr;</span>', 'pheonix' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			the_title( '<span class="screen-reader-text">', '</span>', false )
		);
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pheonix' ),
				'after'  => '</div>',
			)
		);
	} else {
		pheonix_the_excerpt( 100 );
		pheonix_read_more();
	}
	?>
</div>
