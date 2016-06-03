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

<?php
	// Get Video ID for first post */
	if ( have_posts() ) : $i = 0; ?>
	<?php while ( have_posts() ) : the_post(); $i++; ?>
		<?php
			if ($i == 1) {
				$initVideo = get_field('video_id');
			}
		?>
	<?php endwhile; ?>
<?php endif; ?>

<!-- VIDEO CONTAINER -->
<header id="featured-hero" class="hidden" role="banner" style="background-color:#222">

	<div class="feature-overlay"></div>
	<div id="featureVideo" class="row collapse video-container align-center">
		<div class="large-11 columns">
			<div class="flex-video widescreen">
				<script charset="ISO-8859-1" src="//fast.wistia.com/assets/external/E-v1.js" async></script>
				<div class="wistia_embed wistia_async_<?php echo $initVideo; ?> videoFoam=true" style="height:720px;width:1280px">&nbsp;</div>
			</div>
		</div>
	</div>

</header>
<!-- CLOSE VIDEO CONTAINER -->

<section id="archiveWork" role="main">
	<!-- HEADLINE -->
	<header class="headline pad">
	  <div class="row align-center">
	    <div class="small-11 medium-8 columns">
	      <h2><?php the_field("work_headline", "option"); ?></h2>
	    </div>

	    <?php if( have_rows('work_ctas', "option") ) : ?>
	      <div class="small-11 medium-4 columns button-jar">
	      <?php while ( have_rows('work_ctas', "option") ) : the_row(); ?>
	        <a href="<?php the_sub_field('button_url'); ?>" class="button radius large"><?php if(get_sub_field('button_icon')) {the_sub_field('button_icon');} ?> <?php the_sub_field('button_value'); ?></a>
	      <?php endwhile; ?>
	      </div>
	    <?php endif; ?>
	  </div>
	</header>
	<!-- CLOSE HEADLINE -->


	<article class=" pad">
	<?php if ( have_posts() ) : $i = 0; // If we have posts let's begin ?>
		<div class="row small-up-2 medium-up-2 large-up-3 work-grid">

		<?php while ( have_posts() ) : the_post(); // Let's loop through all our posts at output each one while we have posts ?>
			<?php
				// Setting up some variabels to make life a little easier
				$setColor =  get_field('primary_color');
				$color = $setColor;
				$primary = foundationpress_hex2rgba($color, 0.8);
				$secondary = substr(get_field( 'secondary_color'), 1);
				$video =  get_field('video_id');

				// Have to do a lil loop to get the a-singular client
				$clients = get_field('client');
				if( $clients ) {
					foreach( $clients as $p ) {
			    	$client = get_the_title( $p->ID );
					}
				}
			?>
		  <div class="column">
				<div class="work-block">
					<a href="#wistia_<?= $video; ?>?videoFoam=true&playerColor=<?= $secondary; ?>&videoQuality=hd-only">
						<div class="thumbnail-overlay" style="background-color: <?= $primary; ?>">
							<div class="play row align-middle">
								<div class="columns">
									<span><i class="fa fa-play" aria-hidden="true"></i></span>
								</div>
							</div>
						</div>
					</a>
					<a href="<?php the_permalink(); ?>">
						<div class="work-meta row align-middle">
							<div class="columns">
								<h4 style="color:<?php the_field( 'primary_color' ) ?>"><?= $client ?></h4>
								<h2><?php the_title(); ?></h2>
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
