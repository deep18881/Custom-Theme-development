<?php
/**
 * Displaying the content if there are no posts
 *
 * @package Phoenix
 */

?>
<section class="no-results not-found"></section>
	<header class="page-header">
		<h1 class="page-title scree-reader-text">
			<?php esc_html_e( 'Nothing Found', 'pheonix' ); ?>
		</h1>
	</header>
<?php
// Add condition is !front page and user can create posts and then display the message here and link with new post link.
if ( ! is_front_page() && current_user_can( 'publish_posts' ) ) :
	?>
	<p>
		<?php
		// wp_kses function which will accept a tags.
		// Translators: %s is a placeholder for the post link.
		// This code is using the `printf` function to print out a string that includes a link.
		// The string is passed to `wp_kses`, which is a WordPress function used to sanitize HTML.
		// The function is passed two arguments: the string, and an array of allowed HTML tags and attributes.
		// The allowed tags and attributes are specified in the array. In this case, only the 'a' tag is allowed,
		// and the 'href' attribute is allowed on the 'a' tag.
		// The function takes the sanitized string and the 'pheonix' parameter and uses them to print out the final string.
		printf(
			wp_kses(
				// Translators: %s is a placeholder for the post link.
				__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'pheonix' ),
				array(
					'a' => array(
						'href' => array(),
					),
				)
			),
			esc_url( admin_url( 'post-new.php' ) )
		);
		?>
	</p>
	<?php
else :
	?>
	<div class="page-content">
		<p>
			<?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'pheonix' ); ?>
		</p>
		<?php get_search_form(); ?>
	</div>  
	<?php
endif;
?>
