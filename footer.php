<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

 if ( is_post_type_archive('work') ) {
	 $primaryColor = get_field( 'work_primary_color', 'option' );
	 $secondaryColor = get_field( 'work_secondary_color', 'option' );
 } elseif ( is_post_type_archive('team') ) {
	 $primaryColor = get_field( 'team_primary_color', 'option' );
	 $secondaryColor = get_field( 'team_secondary_color', 'option' );
 } else {
	 $primaryColor = get_field( 'primary_color' );
	 $secondaryColor = get_field( 'secondary_color' );
 }

?>
		</section>
		<div id="footer-container" style="background-color: <?= $secondaryColor; ?>">
			<footer id="footer" class="row">
				<div class="small-12 large-9 columns">
					<h2><?php the_field( 'footer_headline', 'option' ); ?></h2>
					<div class="footer-info float-left">
						<span>VERACITYCOLAB</span><br><br>
						<span><?php the_field( 'company_address', 'option' ); ?></span><br><br>
						<a href="tel:<?php the_field( 'company_phone', 'option' ); ?>"><?php the_field( 'company_phone', 'option' ); ?></a>
					</div>
					<div class="footer-menu float-left">
						<?php foundationpress_footer_nav(); ?>
					</div>
				</div>
				<div class="small-12 large-3 columns">
          <div class="team-social">
  					<?php
  						if( have_rows('footer_social', 'option') ) {
  							echo "<nav class=\"social-nav\">";
  							while ( have_rows('footer_social', 'option') ) { the_row();
  								$url = get_sub_field('url');
  								echo "<a href=\"" . $url . "\" target=\"_blank\">";
  								the_sub_field('icon');
  								echo "</a>";
  							}
  							echo "</nav>";
  						}
  					?>
				</div>
				<?php do_action( 'foundationpress_before_footer' ); ?>
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
				<?php do_action( 'foundationpress_after_footer' ); ?>
			</footer>
		</div>

		<?php do_action( 'foundationpress_layout_end' ); ?>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>
		</div><!-- Close off-canvas wrapper inner -->
	</div><!-- Close off-canvas wrapper -->
</div><!-- Close off-canvas content wrapper -->
<?php endif; ?>


<?php wp_footer(); ?>
<?php do_action( 'foundationpress_before_closing_body' ); ?>
</div><!-- CLOSE SKROLLR -->
</body>
</html>
