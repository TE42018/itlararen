<?php

function vcas_component_artikel_link()
{
	vc_map(
		array(
			'name' => __('Artikel Link'),
			'base' => 'vcas_artikel_link',
			'category' => __('itlararen.se'),
			'params' => array(
				array(
					'type' => 'dropdown',
					'holder' => __('Field Label',  "text-domain"),
					'class' => 'type',
					'param_name' => 'link_type_image',
					'value' => array(
						__('välj kategori', "text-domain ") => '',
						__('video', "text-domain ") => 'video',
						__('pdf', "text-domain ") => 'pdf',
						__('zip', "text-domain ") => 'zip',
						__('korsord', "text-domain ") => 'korsord',
						__('quiz', "text-domain ") => 'quiz',
						__('kurser', "text-domain ") => 'kursplanering',
					),
					'description' => __(''),
				),
				array(
					'type' => 'vc_link',
					'holder' => 'div',
					'class' => '',
					'heading' => __('Link'),
					'param_name' => 'url',
					'value' => __(''),
					'description' => __(''),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Field Label',  "my-text-domain" ),
					'param_name' => 'difficulty',
					'value' => array(
					  __( 'välj svårighet',  "my-text-domain"  ) => '',
					  __( 'Lätt',  "my-text-domain"  ) => 'enkel',
					  __( 'Svår',  "my-text-domain"  ) => 'avancerad',
					)
				)
			)
		)	
	);
}

add_action('vc_before_init', 'vcas_component_artikel_link');

function vcas_artikel_link_function($atts, $content)
{
	global $wpdb;
	$date = date("Y-m-d");
	$org = $atts;

	$atts = shortcode_atts(
		array(
			'link_type_image' => '',
			'url' => '',
			'difficulty' => ''
		),
		$atts,
		'vcas_artikel_link'
	);

		$url = vc_build_link($org['url']);
		$href = $url['url'];
		$image_type = $org['link_type_image'];
		$difficulty = $org['difficulty'];
		$html;
		$title = $url['title'];

		if($title == '')
		{
			$id = url_to_postid($url['url']);
			$title = get_the_title($id);
		}

		ob_start();
		?>
		<div class="article_link_container">
			<a href="<?php echo $href ?>" class="article_link" rel="noopener noreferrer"><?php echo $title ?></a>

		<div class="article_type_img">
		<?php
			if($image_type == 'kursplanering')
			{
				echo("<img src='".plugin_dir_url( __FILE__ )."/img/look.png' class='article_img' alt='kursplanering'>");
			}
			else if ($image_type == 'video')
			{
				echo("<img src='".plugin_dir_url( __FILE__ )."/img/play.png' class='article_img'  alt='video'>");
			}
			else if ($image_type == 'pdf')
			{
				echo("<img src='".plugin_dir_url( __FILE__ )."/img/pdf.png' class='article_img' alt='pdf'>");
			}
			else if ($image_type == 'zip')
			{
				echo("<img src='".plugin_dir_url( __FILE__ )."/img/zip.png' class='article_img' alt='zip'> ");
			}
			else if ($image_type == 'quiz')
			{
				echo("<img src='".plugin_dir_url( __FILE__ )."/img/quiz2.png' class='article_img'  alt='quiz'>");
			}
			else if ($image_type == 'korsord')
			{
				echo("<img src='".plugin_dir_url( __FILE__ )."/img/cross.png' class='article_img'  alt='korsord'>");
			}
			?>
		</div>
		<div class="article_difficulty">
			<?php

			if($difficulty == 'enkel')
			{
				echo('<img src="'.plugin_dir_url( __FILE__ ).'/img/easy.png" class="article_difficulty_img" alt="Difficulty easy">');
			}
			else if ($difficulty == 'avancerad')
			{
				echo('<img src="'.plugin_dir_url( __FILE__ ).'/img/hard.png" class="article_difficulty_img" alt="Difficulty hard">');
			}
		?>
		</div>

		</div>
		<?php
	$html .= ob_get_clean();

return $html;

}
add_shortcode('vcas_artikel_link', 'vcas_artikel_link_function');


?>