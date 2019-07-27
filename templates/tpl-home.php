<?php 
/**
 * The template for displaying sliders and notifications on homepage
 * 
 * @package nautilusnet
 */
?>
<section id="" class="container-fluid sct__homepage">
    <?php 
    if( shortcode_exists('show_notifications') ){
        do_shortcode('[show_notifications]');
    }else{
        echo "Shortcode de notificações não existe.";
    }

    ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sliderWrapper" style="height: 100%;">
        <?php 
        if( shortcode_exists('show_article_sliders') ){
            do_shortcode('[show_article_sliders]');
        }else{
            echo "Shortcode de sliders não existe";
        }
        ?>
    </div>
</section>