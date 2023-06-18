<?php
// modify query loop of the works archive page: show all works, not just the first 10
function mosne_fse_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( is_post_type_archive( 'works' ) ) {
		$query->set( 'posts_per_page', - 1 );
	}
}
add_action( 'pre_get_posts', 'mosne_fse_query' );
