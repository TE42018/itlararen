<?php
function vcas_component_category_bubble() {
vc_map(
    array(
        'name' => __( 'Category bubble' ),
        'base' => 'vcas_category_bubble',
        'category'      => __( 'itlararen.se' ),
        'params' => array(
            array(
                'type' => 'attach_image',
                'holder' => 'div',
                'class' => '',
                'heading' => __( 'Image' ),
                'param_name' => 'bubbleimg',
                'value' => __( '' ),
                'description' => __( 'Image for the anchor bubble' ),
                ),
            array(
                'type' => 'textfield',
                'holder' => 'div',
                'class' => '',
                'heading' => __( 'Title' ),
                'param_name' => 'bubbletitle',
                'value' => __( 'En titel' ),
                'description' => __( 'Header title' ),
            ),
            array(
                'type' => 'textarea',
                'holder' => 'div',
                'class' => '',
                'heading' => __( 'Text' ),
                'param_name' => 'bubbletext',
                'value' => __( 'En titel' ),
                'description' => __( 'Text' ),
                )
            )
        )
    );
}
add_action( 'vc_before_init', 'vcas_component_category_bubble' );

function vcas_category_bubble_function( $atts, $content ) {
	global $wpdb;
    $date = date("Y-m-d");
    $org = $atts;
	
	$atts = shortcode_atts(
		array(
            'bubbleimg' => '',
            'bubbletitle' => '',
            'bubbletext' => '',
		), $atts, 'vcas_category_bubble'
	);

	if(!empty($atts['bubbleimg'])) {
        $image_id = $atts['bubbleimg'];
        $image_url = wp_get_attachment_url($image_id, 'large');
        $title = $atts['bubbletitle'];
        $text = $atts['bubbletext'];
        
		ob_start();
		?>
        <div class="category_bubble" style="background-image: url(<?php echo $image_url;?>);"></div>
        <div class="videoheader">
            <h2><?php echo $title;?></h2>
        </div>
        <p class="vidtext">
            <?php echo $text;?>	
        </p>
        
		<?php
		$html .= ob_get_clean();
	}
	else {
		$html = "Image missing!";
	}
	return $html;
}
add_shortcode( 'vcas_category_bubble', 'vcas_category_bubble_function' );

function vc_enqueue_category_style(){
    //wp_register_style( 'itlararen-vc-styles');
    wp_enqueue_style( 'itlararen-vc-style',  plugin_dir_url( __FILE__ ) . 'css/style.css'  );
}
add_action( 'wp_enqueue_scripts', 'vc_enqueue_category_style' );


?>