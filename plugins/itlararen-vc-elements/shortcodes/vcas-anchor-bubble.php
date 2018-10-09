<?php

function vcas_component_article_link() {
vc_map(
    array(
        'name' => __( 'Anchor bubble' ),
        'base' => 'vcas_anchor_bubble',
        'category'      => __( 'itlararen.se' ),
        'params' => array(
            array(
                'type' => 'vc_anchor_bubble',
                'holder' => 'div',
                'class' => '',
                'heading' => __( 'Image:' ),
                'param_name' => 'bubbleimg',
                'value' => __( '' ),
                'description' => __( '' ),
                )
            )
        )
    );
}


add_action( 'vc_before_init', 'vcas_component_article_link' );

function vcas_article_link_function( $atts, $content ) {
	global $wpdb;
    $date = date("Y-m-d");
    $org = $atts;
	
	$atts = shortcode_atts(
		array(
            'articleid' => '',
		), $atts, 'vcas_article_link'
	);

	if(!empty($org['articleid'])) {
		$href = vc_build_link( $org['articleid'] );
		$id = url_to_postid($href['url']);
		
		
		ob_start();
		?>
		<div class="article_link_single">
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
add_shortcode( 'vcas_article_link', 'vcas_article_link_function' );

?>