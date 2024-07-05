<?php
/**
 * Navigation Template
 * This file will handle the navigation for the theme
 *
 * @package Pheonix
 */

// Get Header Menu.
$menu_class_obj = \PHOENIX_THEME\Inc\Menus::get_instance();
// Get Header Menu ID.
$header_menu_id = $menu_class_obj->get_menu_id( 'phoenix-header-menu' );
// get wp get menu item and get menu id.
$header_menu_items = wp_get_nav_menu_items( $header_menu_id );
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
<div class="container-fluid container">
	<?php
	// Display site logo.
	do_action( 'pheonix_site_logo' );
	?>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<?php
		// Check if header menu items is not empty and is array.
	if ( ! empty( $header_menu_items ) && is_array( $header_menu_items ) ) {
		?>
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
		<?php
		// Loop through header menu items.
		foreach ( $header_menu_items as $header_menu_item ) {
			// Check if header menu item parent is not empty.
			if ( ! $header_menu_item->menu_item_parent ) {
				$get_child_menu_items = $menu_class_obj->get_child_menu_items( $header_menu_items, $header_menu_item->ID );
				$has_children         = ! empty( $get_child_menu_items ) && is_array( $get_child_menu_items );
				if ( ! $has_children ) {
					?>
				<li class="nav-item">
				<a class="nav-link active" href="<?php esc_url( $header_menu_item->url ); ?>">
						<?php echo esc_html( $header_menu_item->title ); ?>
				</a>
				</li>
						<?php
				} else {
					?>
				<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="<?php echo esc_url( $header_menu_item->url ); ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<?php echo esc_html( $header_menu_item->title ); ?>
				</a>
				<ul class="dropdown-menu">
						<?php
						foreach ( $get_child_menu_items as $child_menu_item ) {
							?>
					<li><a class="dropdown-item" href="<?php echo esc_url( $child_menu_item->url ); ?>">
							<?php echo esc_html( $child_menu_item->title ); ?>
					</a></li>
							<?php
						}
						?>
				</ul>
				</li>
						<?php
				}
			}
		}
		?>
		</ul>
		<?php
	}
	?>
	<form class="d-flex" role="search">
	<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
	<button class="btn btn-outline-success" type="submit">Search</button>
	</form>
	</div>
</div>
</nav>


