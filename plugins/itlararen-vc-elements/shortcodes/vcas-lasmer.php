<?php

function vcas_component_readmore() {
vc_map(
		array(
			'name' => __( 'Read More' ),
			'base' => 'vcas_readmore ',
			'category'      => __( 'itlararen.se' ),
			'params' => array(
                array(
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Image:' ),
					'param_name' => 'ReadMore_Image',
					'value' => __( '' ),
					'description' => __('Image for the read more boxes'),
				),
                array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Text:' ),
					'param_name' => 'ReadMore_Text ',
					'value' => __( '' ),
					'description' => __('Text for the read more boxes'),
				),
                array(
					'type' => 'vc_link',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Link:' ),
					'param_name' => 'ReadMore_Link',
					'value' => __( '' ),
					'description' => __('Link for the read more boxes'),
				)
			)
		)
	);
    //echo "hekkdwad";
}


add_action( 'vc_before_init', 'vcas_component_readmore' );

function vcas_readmore_function( $atts, $content ) {
	global $wpdb;
    $date = date("Y-m-d");
    $org = $atts;
	
	$atts = shortcode_atts(
		array(
            'ReadMore_Image' => '',
		), $atts, 'vcas_readmore'
	);

	if(!empty($atts['ReadMore_Image'])) {
        $image = $atts['ReadMore_Image'];
        $image_url = wp_get_attachment_url($image, 'thumbnail');
		ob_start();
		?>
    <!--<img src="<//?php echo $image_url ?>" />    -->
		<?php
		//$html .= ob_get_clean();
	}
	else {
		$html = "Link missing!";
	}
	return $html;
}
add_shortcode( 'vcas_readmore', 'vcas_readmore_function' );

?>