<?php

function vcas_component_anchor_bubble() {
vc_map(
    array(
        'name' => __( 'Anchor bubble' ),
        'base' => 'vcas_anchor_bubble',
        'category'      => __( 'itlararen.se' ),
        'params' => array(
            array(
                'type' => 'attach_image',
                'holder' => 'div',
                'class' => 'anchor-bubble',
                'heading' => __( 'Image:' ),
                'param_name' => 'bubbleimg',
                'value' => __( '' ),
                'description' => __( '' ),
                )
            )
        )
    );
}


add_action( 'vc_before_init', 'vcas_component_anchor_bubble' );

function vcas_anchor_bubble_function( $atts, $content ) {
	global $wpdb;
    $date = date("Y-m-d");
    $org = $atts;
	
	$atts = shortcode_atts(
		array(
            'bubbleimg' => '',
		), $atts, 'vcas_anchor_bubble'
	);

	if(!empty($atts['bubbleimg'])) {
        $image_id = $atts['bubbleimg'];
        $image_url = wp_get_attachment_url($image_id, 'small');
        
		ob_start();
		?>
       
        <img src="<?php echo $image_url ?>" alt="Bubble image" /> 
        
		<?php
		$html .= ob_get_clean();
	}
	else {
		$html = "Image missing!";
	}
	return $html;
}
add_shortcode( 'vcas_anchor_bubble', 'vcas_anchor_bubble_function' );

?>