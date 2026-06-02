<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			'subheader'    => array(
				'label' => esc_html__( 'SubHeader', 'mirasat' ),
				'type'  => 'text',
			),				
			'photos' => array(
				'label' => esc_html__( 'Multi Upload', 'mirasat' ),
				'type'  => 'multi-upload',
				),
			),
		),
	);

