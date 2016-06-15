<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if (get_field( 'primary_color' ) && get_field( 'secondary_color' )) {
	$primaryColor = get_field( 'primary_color' );
	$secondaryColor = get_field( 'secondary_color' );
 } else {
	 $primaryColor = get_field( 'global_primary_color', 'options' );
	 $secondaryColor = get_field( 'global_secondary_color', 'options' );
 }

get_header(); ?>

<section id="blog" role="main">
	<!-- HEADLINE -->
		<header class="headline pad"
			data-0="transform: translate(0px, 0px)"
			data-200="transform: translate(0px, -50px)"
			data-400="transform: translate(0px, -100%)">
		<div class="row align-center">
			<div class="small-8 columns">
				<h2>Headline</h2>
			</div>

			<?php if( have_rows('work_ctas', "option") ) : ?>
				<div class="small-4 columns button-jar">
				<?php while ( have_rows('work_ctas', "option") ) : the_row(); ?>
					<a href="<?php the_sub_field('button_url'); ?>" class="button radius large"><?php if(get_sub_field('button_icon')) {the_sub_field('button_icon');} ?> <?php the_sub_field('button_value'); ?></a>
				<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</header>
	<!-- CLOSE HEADLINE -->

	<article class="main-content pad">
	<?php if ( have_posts() ) : ?>
		<div class="row post-grid collapse present">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
				// Setting up some variabels to make life a little easier
				$setColor =  $primaryColor;
				$color = $setColor;
				$primary = foundationpress_hex2rgba($color, 0.8);
				$secondary = substr($secondaryColor, 1);

				// Have to do a lil loop to get the a-singular client
					$categories = get_the_category();
					$i = 0;
					foreach($categories as $term) {
						$i++;
						if ($i == 1) {
							$slug = $term->slug;
						}
					}
			?>
			<div class="columns small-12">
				<a href="<?php the_permalink(); ?>" class="permalink bloglink">
					<div class="hover-indicator" style="background: <?= $primaryColor; ?>"></div>
					<div class="post-meta">
						<h3><?php the_title(); ?></h3>
						<h4><span class="float-right"><?= $slug; ?></span></h4>
					</div>
					<div class="post-block">
						<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							}
						?>
						<div class="thumbnail-overlay" style="background-color: <?= $primary; ?>">
							<div class="row excerpt">
								<div class="columns small-9 medium-6">
									<span><?php the_excerpt(); ?></span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; // End have_posts() check. ?>

		<div id="contentFooter">
		<?php /* Display navigation to next/previous pages when applicable */ ?>
		<?php if ( function_exists( 'foundationpress_pagination' ) ) { foundationpress_pagination(); } else if ( is_paged() ) { ?>
			<nav id="post-nav">
				<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
				<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
			</nav>
		<?php } ?>
		</div>

	</article>
</section>

<?php get_footer();
