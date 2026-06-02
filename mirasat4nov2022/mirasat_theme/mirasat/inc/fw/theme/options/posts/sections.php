<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$options = array(
	'theme_block' => array(
		'title'   => esc_html__( 'Theme Block', 'mirasat' ),
		'label'   => esc_html__( 'Theme Block', 'mirasat' ),
		'type'    => 'select',
		'choices' => array(
			'none'  => esc_html__( 'Not Assigned', 'mirasat' ),
			'before_footer'  => esc_html__( 'Before Footer', 'mirasat' ),
			'subscribe'  => esc_html__( 'Subscribe', 'mirasat' ),
			'top_bar'  => esc_html__( 'Top Bar', 'mirasat' ),
		),
		'value' => 'none',
	)
);


