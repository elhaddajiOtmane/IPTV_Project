<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => '',
		'type'    => 'box',
		'options' => array(
			'role'    => array(
				'label' => esc_html__( 'Role', 'mirasat' ),
				'type'  => 'text',
			),					
			'image' => array(
				'label' => esc_html__( 'Image', 'mirasat' ),
				'type'  => 'upload',
			),
		),
	),
);

