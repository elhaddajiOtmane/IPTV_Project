<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			'subheader'    => array(
				'label' => esc_html__( 'Subheader', 'mirasat' ),
				'type'  => 'text',
			),
			'rate'    => array(
				'type'    => 'select',
				'label' => esc_html__( 'Rate', 'mirasat' ),				
				'description'   => esc_html__( 'Null for hidden', 'mirasat' ),
				'choices' => array(
					0,1,2,3,4,5
				),
			),						
			'short'    => array(
				'type'    => 'checkbox',
				'label' => esc_html__( 'Short Testimonial', 'mirasat' ),				
				'description'   => esc_html__( 'Image will be hiddem and layout inverted', 'mirasat' ),
			),				
		),
	),		
);

