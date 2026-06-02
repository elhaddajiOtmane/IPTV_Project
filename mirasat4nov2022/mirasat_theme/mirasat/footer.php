<?php
/**
 * The template for displaying the footer
 */
?>
        </div>
    </div>
<?php

    mirasat_the_before_footer();
    
?>
    <div class="ltx-footer-wrapper">
<?php
    /**
     * Before Footer area
     */
    mirasat_the_subscribe_block();

    /**
     * Footer widgets area
     */
    mirasat_the_footer_widgets();

    /**
     * Copyright
     */
    mirasat_the_copyrights_section();
?>
    </div>
<?php 

    mirasat_the_go_top();

    /**
     * WordPress Core Function
     */   
    wp_footer();
?>
</body>
</html>
