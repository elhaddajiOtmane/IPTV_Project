<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			'cut'    => array(
				'label' => esc_html__( 'Short Description', 'mirasat' ),
				'type'  => 'textarea',
			),			
			'items' => array(
				'label' => esc_html__( 'Social Icons For List', 'mirasat' ),
				'type' => 'addable-box',
				'value' => array(),
				'box-options' => array(
					'icon' => array(
						'label' => esc_html__( 'Icon', 'mirasat' ),
						'type'  => 'icon',
					),
					'href' => array(
						'label' => esc_html__( 'Link', 'mirasat' ),
						'desc' => esc_html__( 'If needed', 'mirasat' ),
						'type' => 'text',
						'value' => '#',
					),
				),
				'template' => '{{- icon }}',
			),			
		),
	),		
);

