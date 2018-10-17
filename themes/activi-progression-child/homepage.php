<?php

/**
 * Template Name: Home Page
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
				<div class="promo skryt1 vc_col-sm-4" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/linux.png);">
					<div class="content">
						<h3>Linux</h3>
						<p>Från grundläggande linux-kunskaper till mer avancerade tillämpningar. Främst exempel med Ubuntu.</p>
						<p><a class="cta" href="videos.html#video1">Läs mer här ⯈</a></p>
					</div>
				</div>
				<div class="promo skryt2 vc_col-sm-4" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/network.png);">
					<div class="content">
						<h3>Nätverk</h3>
						<p>Vill du lära dig hur nätverk fungerar? Fokus på nätverksprotokoll, standarder och nätverksutrustning.</p>
						<p><a class="cta" href="videos.html#video4">Läs mer här ⯈</a></p>
					</div>
				</div>
				<div class="promo skryt3 vc_col-sm-4" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/pc.png);">
					<div class="content">
						<h3>Persondatorer</h3>
						<p>Genomgång av persondatorn och dess delar. Även bärbara datorer och kringutrustning behandlas.</p>
						<p><a class="cta" href="videos.html#video2">Läs mer här ⯈</a></p>
					</div>
				</div>
				<div class="clearfix-pro"></div>
			</div>

			<div class="clearfix-pro"></div>

			<div class="promo_container vc_row">
				<div class="promo skryt1 vc_col-sm-4" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/windows.png);">
					<div class="content">
						<h3>Microsoft Windows</h3>
						<p>Fördjupa dig i Windows klientoperativsystem (7 & 8) samt serveroperativsystem (2008 & 2012).</p>
						<p><a class="cta" href="videos.html#video3">Läs mer här ⯈</a></p>
					</div>
				</div>
				<div class="promo skryt2 vc_col-sm-4" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/cisco.png);">
					<div class="content">
						<h3>Cisco</h3>
						<p>Lär dig CISCO iOS och hur man konfigurerar nätverksutrustning. Fokus på <abbr title="Command Line Interface">CLI</abbr>  </p>
						<p><a class="cta" href="videos.html#video5">Läs mer här ⯈</a></p>
					</div>
				</div>
				<div class="promo skryt3 vc_col-sm-4" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/blandat.png);">
					<div class="content">
						<h3>Blandat</h3>
						<p>Här tar vi upp allt övrigt som kan vara svårt att kategorisera som t.ex. binära talsystemet och säkerhet.</p>
						<p><a class="cta" href="videos.html#video6">Läs mer här ⯈</a></p>
					</div>
				</div>
				<div class="clearfix-pro"></div>
			</div>


		</div><!-- close .width-container-pro -->
	</div><!-- #content-pro -->
	
<?php get_footer(); ?>