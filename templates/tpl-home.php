<?php 
/**
 * The template for displaying sliders and notifications on homepage
 * 
 * @package nautilusnet
 */
?>
<section id="homepage" class="sct__homepage">
    <?php
    if( shortcode_exists('show_article_sliders') ){
        do_shortcode('[show_article_sliders]');
    }else{
        echo "Shortcode de sliders não existe";
    }
    ?>
</section>