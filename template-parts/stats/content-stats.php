<?php
/**
 * The template for displaying stats posts on the front page
 *
 * @package WEN_Travel
 */
$number          = get_theme_mod( 'wen_travel_stats_number', 4 );
$bg_image 		 = get_theme_mod( 'wen_travel_stats_bg_image' );

$bg_image_class = '';

if ( $bg_image ) {
	$bg_image_class = 'has-bg-img';
}

$post_list  = array();
$no_of_post = 0;

$args = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1, // ignore sticky posts.
);

$args['post_type'] = 'page';

	for ( $i = 1; $i <= $number; $i++ ) {
		$wen_travel_post_id = '';

		$wen_travel_post_id = get_theme_mod( 'wen_travel_stats_page_' . $i );

		if ( $wen_travel_post_id && '' !== $wen_travel_post_id ) {
			$post_list = array_merge( $post_list, array( $wen_travel_post_id ) );

			$no_of_post++;
		}
	}

	$args['post__in'] = $post_list;
	$args['orderby']  = 'post__in';

if ( ! $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :

	$loop->the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="hentry-inner <?php echo esc_attr( $bg_image_class ); ?>">
			<?php wen_travel_post_thumbnail( 'wen-travel-stats' ); ?>

			<div class="entry-container">
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
				</header>

				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			</div><!-- .entry-container -->
		</div> <!-- .hentry-inner -->
	</article> <!-- .article -->
<?php
endwhile;

wp_reset_postdata();
