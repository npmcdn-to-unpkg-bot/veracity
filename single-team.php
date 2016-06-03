<?php
/**
 * The template for displaying all work single posts
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>
<div class="show-for-small-only">
<?php get_template_part( 'template-parts/featured-image' ); ?>
</div>

<section id="singleTeam" role="main" class="parallax-parent">
	<div class="parallax-bg" style="background: url(<?php the_post_thumbnail_url( 'full' ); ?>)"
		data-center-center="background-position: 50% 100px;"
		data-top-bottom="background-position: 50% -200px"
		data-anchor-target="#teamContent">
	</div>
	<div class="row align-right expanded collapse">
		<div class="columns small-12 medium-9 large-7">
		<?php do_action( 'foundationpress_before_content' ); ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<article class="main-content" id="teamContent"
		    data-0="transform: translate(0, 0px);"
		    data-top-bottom="transform: translate(0, -200px)">
				<header class="text-center">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<h4 class="entry-title"><?php the_field('title'); ?></h4>
				</header>
				<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
				<div id="contentBody" class="entry-content">

				<?php the_content(); ?>

				<?php
					if( have_rows('links') ) {
						echo "<nav class=\"social-nav\">";
						while ( have_rows('links') ) { the_row();
							$url = get_sub_field('url');
							echo "<a href=\"" . $url . "\" target=\"_blank\">";
							the_sub_field('icon');
							echo "</a>";
						}
						echo "</nav>";
					}
				?>
				</div>
			</article>
		<?php endwhile;?>

		<?php do_action( 'foundationpress_after_content' ); ?>
		</div><!-- close column -->
	</div><!-- close row-->
</section>

<?php get_footer();
