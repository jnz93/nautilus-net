<?php 
/**
 * The template for index
 * @package nautilusnet
 */
get_header();
?>
<div id="" class="body-content">
    <?php 
    if( have_posts() && false ){
        while( have_posts() ){
            the_post(); ?>
            <div class="">
                <?php get_template_part('content/content', get_post_format() ); ?>
            </div>
        <?php
        }
    } else {
        get_template_part('homepage-custom');
    }
    ?>
</div>

<?php get_footer(); ?>