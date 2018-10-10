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
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => 'linkimage',
					'heading' => __('image'),
					'param_name' => 'link_type_image',
					'value' => '',
					'description' => __(''),
				),
				array(
					'type' => 'vc_link',
					'holder' => 'div',
					'class' => '',
					'heading' => __('Länk:'),
					'param_name' => 'url',
					'value' => __(''),
					'description' => __(''),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Field Label',  "my-text-domain" ),
					'param_name' => 'field_name',
					'value' => array(
					  __( 'Lätt',  "my-text-domain"  ) => 'option1value',
					  __( 'Svår',  "my-text-domain"  ) => 'option2value',
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
			'url' => '',
			'link_type_image' => '',
			'difficultyImage' => ''
		),
		$atts,
		'vcas_artikel_link'
	);

	if (!empty($atts['link_type_image'])) {
		$href = $atts['url'];
		//$id = url_to_postid($href['url']);

		$image_id = $atts['link_type_image'];
		$image_url = wp_get_attachment_url($image_id, 'thumbnail');

		$html .= $href;
		ob_start();
		?>
		

		<img src="<?php echo $image_url ?>" alt="Article image"/>
		
	

		<?php
	$html .= ob_get_clean();
} else {
	$html = "Link missing!";
}
return $html;

}
add_shortcode('vcas_artikel_link', 'vcas_artikel_link_function');

?>