<?php 
/**
 * The template for displaying sliders and notifications on homepage
 * 
 * @package nautilusnet
 */
?>
<section id="" class="container-fluid">
    <?php 
    if( shortcode_exists('show_notifications') ){
        do_shortcode('[show_notifications]');
    }else{
        echo "Shortcode de notificações não existe.";
    }

    if( shortcode_exists('show_article_sliders') ){
        do_shortcode('[show_article_sliders]');
    }else{
        echo "Shortcode de sliders não existe";
    }
    ?>
</section>