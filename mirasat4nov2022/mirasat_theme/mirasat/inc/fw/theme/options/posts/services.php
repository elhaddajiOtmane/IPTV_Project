<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(			
			'header'    => array(
				'label' => esc_html__( 'Alternative Header', 'mirasat' ),
				'desc' => esc_html__( 'Use {{ brackets }} to headlight', 'mirasat' ),
				'type'  => 'text',
			),		
			'image' => array(
				'label' => esc_html__( 'Additional Image', 'mirasat' ),
				'type'  => 'upload',
			),
			'icon' => array(
				'label' => esc_html__( 'Icon', 'mirasat' ),
				'type'  => 'icon-v2',
			),			
			'cut'    => array(
				'label' => esc_html__( 'Short Description', 'mirasat' ),
				'type'  => 'textarea',
			),							
			'price'    => array(
				'label' => esc_html__( 'Price', 'mirasat' ),
				'desc' => esc_html__( 'Use {{ brackets }} to headlight', 'mirasat' ),
				'type'  => 'text',
			),					
			'link'    => array(
				'label' => esc_html__( 'External Link', 'mirasat' ),
				'desc' => esc_html__( 'Replaces default service link', 'mirasat' ),				
				'type'  => 'text',
			),		
			'items' => array(
				'label' => esc_html__( 'Charts', 'mirasat' ),
				'type' => 'addable-box',
				'value' => array(),
				'box-options' => array(
					'header' => array(
						'label' => esc_html__( 'Header', 'mirasat' ),
						'type' => 'text',
					),
					'value' => array(
						'label' => esc_html__( 'Value', 'mirasat' ),
						'type' => 'text',
					),					
				),
				'template' => '{{- header }}',
			),						
		),
	),
);

