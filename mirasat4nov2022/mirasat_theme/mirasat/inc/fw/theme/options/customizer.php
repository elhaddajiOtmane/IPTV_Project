<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$mirasat_cfg = mirasat_theme_config();

$options = array(
    
    'mirasat_customizer' => array(
        'title' => esc_html__('Mirasat Colors', 'mirasat'),
        'position' => 1,
        'options' => array(

            'main_color' => array(
                'type' => 'color-picker',
                'value' => $mirasat_cfg['color_main'],
                'label' => esc_html__('Main Color', 'mirasat'),
            ),            
            'second_color' => array(
                'type' => 'color-picker',
                'value' => $mirasat_cfg['color_second'],
                'label' => esc_html__('Second Color', 'mirasat'),
            ),                
            'gray_color' => array(
                'type' => 'color-picker',
                'value' => $mirasat_cfg['color_gray'],
                'label' => esc_html__('Gray Color', 'mirasat'),
            ),
            'black_color' => array(
                'type' => 'color-picker',
                'value' => $mirasat_cfg['color_black'],
                'label' => esc_html__('Black Color', 'mirasat'),
            ),      
            'red_color' => array(
                'type' => 'color-picker',
                'value' => $mirasat_cfg['color_red'],
                'label' => esc_html__('Red Color', 'mirasat'),
            ),
            'white_color' => array(
                'type' => 'color-picker',
                'value' => $mirasat_cfg['color_white'],
                'label' => esc_html__('White Color', 'mirasat'),
            ),                          
            'logo_height' => array(
                'type'  => 'slider',
                'value' => $mirasat_cfg['logo_height'],
                'properties' => array(

                    'min' => 0,
                    'max' => 200,
                    'step' => 1,

                ),
                'label' => esc_html__('Logo Max Height, px', 'mirasat'),
            ),    
            'navbar_dark_color' => array(
                'type' => 'rgba-color-picker',
                'value' => $mirasat_cfg['navbar_dark'],
                'label' => esc_html__('Navbar Dark Color', 'mirasat'),
            ),      
        ),
    ),
);

