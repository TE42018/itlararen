<?php

function vcas_component_artikel_link() {
vc_map(
		array(
			'name' => __( 'Artikel Link' ),
			'base' => 'vcas_artikel_link',
			'category'      => __( 'itlararen.se' ),
			'params' => array(
                array(
					'type' => 'vc_link',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Länk:' ),
					'param_name' => 'artikelid',
					'value' => __( '' ),
					'description' => __( 'bbbn b vb bbnnn' ),
					)
				)
			)
		);
}


add_action( 'vc_before_init', 'vcas_component_artikel_link' );

function vcas_artikel_link_function( $atts, $content ) {
	global $wpdb;
    $date = date("Y-m-d");
    $org = $atts;
	
	$atts = shortcode_atts(
		array(
            'artikelid' => '',
		), $atts, 'vcas_artikel_link'
	);

	if(!empty($org['artikelid'])) {
		$href = vc_build_link( $org['artikelid'] );
		$id = url_to_postid($href['url']);
		
		
		ob_start();
		?>
		<div class="artikel_link_single">
		<a href="<?php echo get_permalink($row->ID); ?>" title="<?php echo $row->post_title; ?>" class="vc_gitem-link vc-zone-link">	
		</a>	
		</div>
		<?php
		$html .= ob_get_clean();
	}
	else {
		$html = "Link missing!";
	}
	return $html;
}
add_shortcode( 'vcas_artikel_link', 'vcas_artikel_link_function' );

?>