<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(			
			'director'    => array(
				'label' => esc_html__( 'Director', 'mirasat' ),
				'type'  => 'text',
			),
			'rate'    => array(
				'label' => esc_html__( 'Rate', 'mirasat' ),
				'type'  => 'text',
			),			
			'year'    => array(
				'label' => esc_html__( 'Year', 'mirasat' ),
				'type'  => 'text',
			),
			'duration'    => array(
				'label' => esc_html__( 'Duration', 'mirasat' ),
				'type'  => 'text',
			),
			'photos' => array(
				'label' => esc_html__( 'Gallery', 'mirasat' ),
				'type'  => 'multi-upload',
			),
			'link'    => array(
				'label' => esc_html__( 'External Link', 'mirasat' ),
				'desc' => esc_html__( 'Replaces default link', 'mirasat' ),				
				'type'  => 'text',
			),			
			'header_bg'    => array(
				'label' => esc_html__( 'Header Background', 'mirasat' ),
				'type'  => 'upload',
			),				
		),
	),
);

