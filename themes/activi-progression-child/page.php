<?php

/**
 *
 * @package pro
 * @since pro 1.0
 */
get_header(); ?>
	
	
	<?php if(!get_post_meta($post->ID, 'progression_studios_disable_page_title', true)  ): ?>
	<div id="page-title-pro">
		<div class="width-container-pro">
			<div id="progression-studios-page-title-container">
				<?php if(get_post_meta($post->ID, 'progression_studios_sub_title', true)): ?><h4 class="progression-sub-title"><?php echo wp_kses( get_post_meta($post->ID, 'progression_studios_sub_title', true) , true); ?></h4><?php endif; ?>				
				<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
				<?php if(function_exists('bcn_display')) { echo '<ul id="breadcrumbs-progression-studios">'; bcn_display_list(); echo '</ul>'; }?>
			</div><!-- close #progression-studios-page-title-container -->
			<div class="clearfix-pro"></div>
		</div><!-- close .width-container-pro -->
	</div><!-- #page-title-pro -->
	<?php endif; ?>

	</div><!-- close #progression-studios-header-position -->

	<div id="content-pro">
		<div class="width-container-pro<?php if(get_post_meta($post->ID, 'progression_studios_page_sidebar', true) == 'left-sidebar' ) : ?> left-sidebar-pro<?php endif; ?>">

			
			
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php endwhile; ?>
			
			<div class="clearfix-pro"></div>

			<div class="promo_container vc_row">
			
				<div class="promo skryt1 vc_col-sm-4" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/ubuntuboken.jpg);">
					<div class="content">
						<h3>Ubuntuboken</h3>
						<p>Lär dig allt om Ubuntu världens populäraste linuxdistribution. Utgiven 2010, uppdaterad 2016.</p>
						<p><a class="cta" href="http://www.ubuntuboken.se">Läs mer här ⯈</a></p>
					</div>
				</div>
				<div class="promo skryt2 vc_col-sm-4" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/cert.png);">
					<div class="content">
						<h3>Microsoft Certifikat</h3>
						<p>Vad menas med MCITP, MCSA, MCTS, MTA, MCT? Vad innebär det att vara "certifierad"?</p>
						<p><a class="cta" href="https://www.microsoft.com/en-us/learning/certification-overview.aspx">Läs mer här ⯈</a></p>
					</div>
				</div>
				<div class="promo skryt3 vc_col-sm-4" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/netacad.png);">
					<div class="content">
						<h3>CISCO</h3>
						<p>Vad är CISCO Networking Academy? Läs mer om utbildningsprogrammet och om certifiering.</p>
						<p><a class="cta" href="http://www.netacad.com">Läs mer här ⯈</a></p>
					</div>
				</div>
				
				<div class="clear-fix"></div>
				
				

			</div>
		</div><!-- close .width-container-pro -->
	</div><!-- #content-pro -->
	
<?php get_footer(); ?>