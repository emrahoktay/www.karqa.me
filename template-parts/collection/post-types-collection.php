<?php
/**
 * The template for displaying collection items
 *
 * @package WEN_Travel
 */

$wen_travel_number    = get_theme_mod( 'wen_travel_collection_number', 4 );

if ( ! $wen_travel_number ) {
	// If number is 0, then this section is disabled
	return;
}

$wen_travel_args = array(
	'orderby'             => 'post__in',
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$wen_travel_post_list  = array();// list of valid post/page ids

$wen_travel_no_of_post = 0; // for number of posts

$wen_travel_args['post_type'] = 'page';

for ( $wen_travel_i = 1; $wen_travel_i <= $wen_travel_number; $wen_travel_i++ ) {
	$wen_travel_post_id = '';

	$wen_travel_post_id = get_theme_mod( "wen_travel_collection_page_{$wen_travel_i}" );

	if ( $wen_travel_post_id && '' !== $wen_travel_post_id ) {
		// Polylang Support.
		if ( class_exists( 'Polylang' ) ) {
			$wen_travel_post_id = pll_get_post( $wen_travel_post_id, pll_current_language() );
		}

		$wen_travel_post_list = array_merge( $wen_travel_post_list, array( $wen_travel_post_id ) );

		$wen_travel_no_of_post++;
	}
}

$wen_travel_args['post__in'] = $wen_travel_post_list;


if ( 0 === $wen_travel_no_of_post ) {
	return;
}

$wen_travel_args['posts_per_page'] = $wen_travel_no_of_post;
$wen_travel_loop     = new WP_Query( $wen_travel_args );

if ( $wen_travel_loop -> have_posts() ) :
	while ( $wen_travel_loop -> have_posts() ) :
		$wen_travel_loop -> the_post();

		$wen_travel_categories_list = get_the_category();

		$wen_travel_classes = 'grid-item';
		foreach ( $wen_travel_categories_list as $wen_travel_cat ) {
			$wen_travel_classes .= ' ' . $wen_travel_cat->slug ;
		}

		$wen_travel_classes .= ' no-meta';

		$wen_travel_thumbnail = array(508, 522);
		if ( 0 === $wen_travel_loop->current_post ) {
			$wen_travel_classes .= ' wide';
			$wen_travel_thumbnail = array(920, 433);
		} elseif ( 1 === $wen_travel_loop->current_post ) {
			$wen_travel_thumbnail = array(508, 1068);
		}
		?>
		<article id="collection-post-<?php the_ID(); ?>" <?php post_class( esc_attr( $wen_travel_classes ) ); ?>>
			<div class="hentry-inner">

				<?php
				if( has_post_thumbnail() ) {
					wen_travel_post_thumbnail( $wen_travel_thumbnail, 'html', true, true );
				} else {
					wen_travel_post_thumbnail( $wen_travel_thumbnail, 'html', true, true );
				} ?>

				<div class="entry-container caption">
					<div class="entry-container-inner-wrap">
						<header class="entry-header">
							<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
						</header>
					</div><!-- .entry-container-inner-wrap -->
				</div><!-- .entry-container -->
			</div><!-- .hentry-inner -->
		</article>

	<?php
	endwhile;
	wp_reset_postdata();
endif;
