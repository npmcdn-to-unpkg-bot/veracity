<?php
/**
 * The template for displaying all work single posts
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<section id="singleWork" role="main">
<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>

	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>"
    data-bottom-top="margin-top: -100px;"
    data-top-bottom="margin-top: -900px;">
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
		<div id="contentBody" class="entry-content">

		<?php the_content(); ?>
		</div>
		<footer>
			<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
			<p><?php the_tags(); ?></p>
		</footer>
		<?php do_action( 'foundationpress_post_before_comments' ); ?>
		<?php comments_template(); ?>
		<?php do_action( 'foundationpress_post_after_comments' ); ?>
	</article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
<aside class="sidebar">
  <div clas="row" data-sticky-container>
    <div class="sticky" data-sticky data-anchor="singleWork" data-check-every="0">
      <span><?php the_field('completion_date'); ?></span><br>

			<!-- CREDITS SECTION -->
			<?php
				if( have_rows('credits') ) {
					echo "<div class='credits'>";
					while ( have_rows('credits') ) { the_row();
						$title = get_sub_field('title');
						if (get_sub_field('veracity_employee') == true) {
								$posts = get_sub_field('team_member');
								if( $posts ){
									foreach( $posts as $p ) {
										$permalink = get_permalink( $p->ID );
										$name = get_the_title( $p->ID );
										echo '<span>' . $title . ': <strong>' . $name . '</strong></span><br>';
									}
								}
						} else {
							$name = get_sub_field('name');
							echo '<span>' . $title . ': <strong>' . $name . '</strong></span><br>';
						}
					}
					echo "</div>";
				}
			?>

			<!-- CATEGORIES SECTION -->
			<?php
				$terms = get_field('categories');
				if( $terms ): ?>
					<div class="categories">
						<span>Categories:</span><br>
						<?php foreach( $terms as $term ): ?>
							<a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>,
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<!-- SHARE SECTION -->
				<span>Share:</span><br>
    </div>
  </div>
</aside>
</section>

<?php get_footer();
