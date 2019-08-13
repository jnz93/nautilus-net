<?php 
/**
 * The template for displaying sliders and notifications on homepage
 * 
 * @package nautilusnet
 */
?>
<section id="homepage" data-wow-delay=".1s" class="wow fadeIn sct__homepage">
    <div class="col-lg-11 row sct__contentWrapper sct__contentWrapper--noMargin" style="height: 100%;">
        <?php 
        // Notificações
        if( shortcode_exists('show_notifications') ){
            do_shortcode('[show_notifications]');
        }else{
            echo "Shortcode de notificações não existe.";
        }

        // Sliders
        if( shortcode_exists('show_article_sliders') ){
            echo '<div class="articleHome__wrapperSlider">';
            do_shortcode('[show_article_sliders]');
            echo '</div>';
        }else{
            echo "Shortcode de sliders não existe";
        }
        ?>
    </div>
</section>