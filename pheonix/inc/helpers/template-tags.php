<?php
/**
 * Custom template tags which will include function.
 *
 * @package Pheonix
 */

/**
 * Get the custom thumbnail for a post.
 *
 * @param int    $post_id The ID of the post. If empty, the ID of the global `$post` will be used.
 * @param string $size    The size of the thumbnail. Default is 'featured-thumbnail'.
 * @param array  $additional_attributes Additional attributes for the image element. Default is an empty array.
 * @return string The HTML markup for the image element, or an empty string if the post has no featured image.
 */
function get_the_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attributes = array() ) {
	// Check if the post ID is empty. If yes, get the ID of the global `$post` and assign it.
	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	// Check if the post has a featured image.
	if ( has_post_thumbnail( $post_id ) ) {
		// Retrieve an image element for a given attachment ID.
		//
		// The function takes four arguments:
		// - `$attachment_id` (required): The ID of the attachment.
		// - `$size` (optional): The size of the image.
		// - `$icon` (optional): The URL of an icon to use if the attachment is missing.
		// - `$attr` (optional): Additional attributes for the image element.
		//
		// The function returns the HTML markup for the image element.
		$custom_thumbnail = wp_get_attachment_image( get_post_thumbnail_id( $post_id ), $size, false, $additional_attributes );
	} else {
		$custom_thumbnail = '';
	}

	/**
	 * Escape the custom thumbnail output.
	 *
	 * @link https://developer.wordpress.org/reference/functions/esc_html/
	 */
	return $custom_thumbnail;
}


/**
 * Prints the custom thumbnail for a post.
 *
 * @param int    $post_id The ID of the post. If empty, the ID of the global `$post` will be used.
 * @param string $size    The size of the thumbnail. Default is 'featured-thumbnail'.
 * @param array  $additional_attributes Additional attributes for the image element. Default is an empty array.
 * @return void
 */
function print_post_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attributes = array() ) {
	// Get the custom thumbnail for a post and echo it.
	echo get_the_custom_thumbnail( $post_id, $size, $additional_attributes ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped.
}


/**
 * Get the published date and time of a post.
 *
 * This function formats and echoes the published date and time of a post.
 *
 * @return void
 */
function get_the_post_published_date_and_time() {
	// Define the time string format.
	// %1$s: The date in W3C format.
	// %2$s: The date.
	// %3$s: The modified date in W3C format.
	// %4$s: The modified date.
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	// Check if the post's time has been modified.
	// If it has, use a different time string format.
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	// Format the time string.
	$time_string = sprintf(
		$time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Format the posted on string.
	// %s: The time string.
	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'pheonix' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	// Echo the posted on string.
	echo '<span class="posted-one text-secondary">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Generates the HTML for the "Posted by" section of a post.
 *
 * This function uses the `sprintf` function to format the string and then
 * echoes the resulting HTML. It uses the `esc_html_x` function to translate
 * and escape the string.
 *
 * @return void
 */
function get_the_post_author() {

	// Format the "Posted by" string.
	$posted_by = sprintf(
		/* translators: %s: post author. */
		esc_html_x( ' Posted by %s', 'post author', 'pheonix' ),
		'<span class="Author: Firstname Lastname"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	// Echo the "Posted by" string.
	echo '<span class="posted-by text-secondary">' . $posted_by . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}


/**
 * Display the excerpt of a post, with optional trimming.
 *
 * If the post has no excerpt, or if the trim character count is 0,
 * then the full excerpt is displayed. Otherwise, the excerpt is
 * trimmed to the specified number of characters and any HTML tags
 * are stripped. The trimmed excerpt is then displayed with '[...]'
 * appended.
 *
 * @param int $trim_character_count The number of characters to trim the excerpt to.
 *                                  Default is 0 (no trimming).
 * @return void
 */
function pheonix_the_excerpt( $trim_character_count = 0 ) {
	// Check if the post has an excerpt and if we should trim it.
	if ( ! has_excerpt() || 0 === $trim_character_count ) {
		the_excerpt();
		return;
	}

	// Get the excerpt, strip any HTML tags, and trim it.
	$excerpt = wp_strip_all_tags( get_the_excerpt() );
	$excerpt = substr( $excerpt, 0, $trim_character_count );
	$excerpt = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) ); // get last space.

	// Display the trimmed excerpt with '[...]' appended.
	echo $excerpt . '[...]'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}


/**
 * Displays a "Read More" button for non-single posts.
 *
 * This function generates and echoes a "Read More" button for non-single posts.
 * The button is styled with Bootstrap classes.
 *
 * @return void
 */
function pheonix_read_more() {
	// Check if the current page is a single post.
	if ( ! is_single() ) {
		// Generate the "Read More" button.
		$more = sprintf(
			// The button HTML structure.
			'<button class="read-more-button mt-4 btn btn-info">
				<a class="phoenix-read-more text-white" href="%1$s">%2$s</a>
			</button>',
			// The URL of the post.
			esc_url( get_permalink( get_the_ID() ) ),
			// The "Read More" text.
			__( 'Read More', 'pheonix' )
		);

		// Echo the "Read More" button.
		echo $more; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
