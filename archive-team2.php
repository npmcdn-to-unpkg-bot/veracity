<?php
/**
 * The template for displaying archive work posts
 *
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
get_header(); ?>
<?php /* Convert hexdec color string to rgb(a) string */
	function hex2rgba($color, $opacity = false) {
		$default = 'rgb(0,0,0)';
		//Return default if no color provided
		if(empty($color)) {
			return $default;
		}
		//Sanitize $color if "#" is provided
		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}
		//Check if color has 6 or 3 characters and get values
		if (strlen($color) == 6) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}
		//Convert hexadec to rgb
		$rgb =  array_map('hexdec', $hex);
		//Check if opacity is set(rgba or rgb)
		if($opacity) {
			if(abs($opacity) > 1) {
				$opacity = 1.0;
			}
			$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
		} else {
			$output = 'rgb('.implode(",",$rgb).')';
		}
		//Return rgb(a) color string
		return $output;
	}
?>

<section id="archiveTeam" role="main">
	<article class="main-content pad">
	<?php if ( have_posts() ) : ?>
		<div class="row small-up-2 medium-up-2 large-up-3 team-grid">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php
				// Work Variabels
				$setColor =  get_field('primary_color');
				$color = $setColor;
				$primary = hex2rgba($color, 0.8);

			?>
		  <div class="column">
				<div class="team-block">
					<a href="<?php the_permalink(); ?>">
						<div class="thumbnail-overlay" style="background-color: <?php echo $primary; ?>">
							<div class="play row align-middle">
								<div class="columns">
								</div>
							</div>
						</div>
						<div class="team-meta row align-middle">
							<div class="columns">
								<h4 style="color:<?php the_field( 'primary_color' ) ?>"><?php the_title(); ?></h4>
							</div>
						</div>
						<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							}
						?>
					</a>
				</div>
			</div>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		</div>

		<?php endif; // End have_posts() check. ?>


		<?php /* Display navigation to next/previous pages when applicable */ ?>
		<?php if ( function_exists( 'foundationpress_pagination' ) ) { foundationpress_pagination(); } else if ( is_paged() ) { ?>
			<nav id="post-nav">
				<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
				<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
			</nav>
		<?php } ?>

	</article>
</section>

<?php get_footer();
