<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$options = array(
	'main' => array(
		'title'   => 'LTX Post Format',
		'type'    => 'box',
		'options' => array(
			'gallery'    => array(
				'label' => esc_html__( 'Gallery', 'mirasat' ),
				'desc' => esc_html__( 'Upload featured images for slider gallery post type', 'mirasat' ),
				'type'  => 'multi-upload',
			),				
		),
	),
);

