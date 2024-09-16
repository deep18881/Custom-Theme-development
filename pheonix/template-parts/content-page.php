<?php
/**
 * Content page template.
 *
 * @package Pheonix
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-5' ); ?>>
<?php
if ( ! is_home() && is_front_page() ) {
	?>
	<header class="entry-header">
		<?php
		the_title( '<h1 class="entry-title">', '</h1>' );
		?>
	</header>
	<?php
}
?>
<div class="entry-content">
	<?php
	the_content();
	if ( ! is_home() ) {
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pheonix' ),
				'after'  => '</div>',
			)
		);
	}
	?>
</div>
<footer class="entry-footer">
	<?php
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'pheonix' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
	?>
</footer>
</article>
