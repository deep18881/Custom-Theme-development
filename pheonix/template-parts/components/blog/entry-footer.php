<?php
/**
 * Template for post entry footer.
 *
 * @package Pheonix
 */

// Display post categories.
$categories = wp_get_post_terms( get_the_ID(), array( 'category', 'post_tag' ) );
if ( empty( $categories ) || ! is_array( $categories ) ) {
	return;
}
?>

<div class="entry-footer mt-4">
<?php
foreach ( $categories as $key => $category ) {
	?>
	<button class="btn btn-outline-secondary mb-2 mr-2">
		<a class="text-black-50 entry-footer-link" 	href="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
	</button>
	<?php
}
?>
</div>  
