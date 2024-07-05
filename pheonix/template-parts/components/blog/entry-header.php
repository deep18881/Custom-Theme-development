<?php
/**
 * Template for post entry header.
 *
 * @package Pheonix
 */

// Fetch the post thumbnail.
if ( has_post_thumbnail() ) {
	$thumbnail = get_the_post_thumbnail( get_the_ID() );
}
// Check if post title is hidden.
$hide_title    = get_post_meta( get_the_ID(), 'post_hide_title', true );
$heading_class = ! isset( $hide_title ) ? 'hide' : '';
?>
<header class="entry-header">
	<?php
	if ( isset( $thumbnail ) ) {
		?>
		<div class="entry-image post-thumbnail mb-3">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
			<?php
			print_post_thumbnail(
				get_the_ID(),
				'featured-thumbnail',
				array(
					'sizes' => '(max-width: 356px) 356px, 188px',
					'class' => 'attachment-featured-large size-featured-large',
				)
			);
			?>
			</a>
		</div>
		<?php
	}
	?>
	<?php

	// check if it single post page.
	if ( is_single() && is_page() ) {
		printf(
			'<h1 class="entry-title %1$s">%2$s</h1>',
			esc_html( $heading_class ),
			wp_kses_post( get_the_title() )
		);
	} else {
		printf(
			'<h2 class="entry-title %1$s"><a class="text-dark" href="%2$s">%3$s</a></h2>',
			esc_html( $heading_class ),
			esc_url( get_permalink() ),
			wp_kses_post( get_the_title() )
		);
	}

