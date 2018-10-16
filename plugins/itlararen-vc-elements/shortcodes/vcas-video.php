<?php

function vcas_component_video() {
vc_map(
		array(
			'name' => __( 'Video (custom)' ),
			'base' => 'vcas_video ',
			'category'      => __( 'itlararen.se' ),
			'params' => array(
                array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Url:' ),
					'param_name' => 'video_url',
					'value' => __( '' ),
					'description' => __('Link to MP4 file'),
				),
			)
		)
	);
}


add_action( 'vc_before_init', 'vcas_component_video' );

function vcas_video_function( $atts, $content ) {
    $org = $atts;
	
	$atts = shortcode_atts(
		array(
			'video_url' => '',
			'video_poster' => '',
		), $atts, 'vcas_video'
	);

	if(!empty($atts['video_url'])) {
		$poster = substr($atts['video_url'],0, -3)."jpg";
		$webm  = substr($atts['video_url'],0, -3)."webm";
		ob_start();
	?>		
		<video id="myVideo" controls  poster="<?php echo $poster ?>">
				   <source src="<?php echo $atts['video_url'] ?>" type="video/mp4">	   	
				   <source src="<?php echo $webm ?>" type="video/webm">	    
				   <p> Din webbläsare stöder inte HTML5-video. Prova att uppgradera webbläsare. Alla populära webbläsare
						såsom, IE, Firefox, Chrome, Opera och Safari har stöd för HTML5-video. 
				   </p>
				</video>
				<p> <input type="button" onclick="setPlaySpeed()" type="button" id="knapp2" value="x1.0" /> Klicka på knappen för att ändra uppspelningshastigheten</p>

				<h3>Längd: <span id="myVideoLength">0</span> min</h3>
				<h3>Nivå: <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/easy.png" alt="Svårighetsgrad enkel" /> (enkel)</h3>
				<p>
					<b>OBS allt egenproducerat material är skyddat av upphovsrättslagen
					och användandet av dessa filmer är ej tillåtet i kommersiellt syfte (gäller även skolor) utan avtal med IT-läraren Skåne.</b> 
				</p>
	<?php
		$html = ob_get_clean();
	}
	else {
		$html = "Link missing!";
	}
	return $html;
}
add_shortcode( 'vcas_video', 'vcas_video_function' );

function itlararen_elements_enqueue_video_script() {   
    wp_enqueue_script( 'video_player', plugin_dir_url( __FILE__ ) . 'js/video_player.js' );
}
add_action('wp_enqueue_scripts', 'itlararen_elements_enqueue_video_script');


?>