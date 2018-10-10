<?php
function vcas_component_gauge() {
	vc_map(
		array(
			'name' => __( 'Gauge' ),
			'base' => 'vcas_gauge',
			'category'      => __( 'itlararen.se' ),
			'params' => array(
                array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Procent:' ),
					'param_name' => 'procent',
					'value' => '100',
					'description' => __( '' ),
					),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Titel:' ),
					'param_name' => 'title',
					'value' => 'En titel',
					'description' => __( '' ),
					),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Label:' ),
					'param_name' => 'label',
					'value' => 'En label',
					'description' => __( '' ),
					)
				)
			)
		);
}
add_action( 'vc_before_init', 'vcas_component_gauge' );

function vcas_gauge_function( $atts, $content ) {
    $date = date("Y-m-d");
    $org = $atts;
	
	$atts = shortcode_atts(
		array(
            'procent' => '100',
			'title' => 'En titel',
			'label' => 'En label'
		), $atts, 'vcas_gauge'
	);

	if(is_numeric($atts['procent'])) {
		$html='<div id="gauge" ></div>
				<script>
					var g = new JustGage({
					id: "gauge",
					value: '.$atts['procent'].',
					min: 0,
					max: 100,
					title: "'.$atts['title'].'",
					label: "'.$atts['label'].'",
					startAnimationType : "bounce",
					startAnimationTime : 5000,
					levelColors: ["#c1746c", "#fb9d38", "#fdef4e", "#89ce65"]
					});
				</script>';	
	}
	else {
		$html = "Ange ett tal mellan 0-100!";
	}
	return $html;
}
add_shortcode( 'vcas_gauge', 'vcas_gauge_function' );

function csharp_elements_enqueue_gauge_script() {   
    wp_enqueue_script( 'justgage_raphael', plugin_dir_url( __FILE__ ) . 'js/raphael.2.1.0.min.js' );
    wp_enqueue_script( 'justgage_core', plugin_dir_url( __FILE__ ) . 'js/justgage.1.0.1.min.js' );
}
add_action('wp_enqueue_scripts', 'csharp_elements_enqueue_gauge_script');


?>