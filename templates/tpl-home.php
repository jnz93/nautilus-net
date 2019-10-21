<?php 
/**
 * The template for displaying sliders and notifications on homepage
 * 
 * @package nautilusnet
 */
?>
<section id="homepage" class="sct__homepage">
    <?php do_shortcode('[show_article_sliders]'); ?>
    <?php do_shortcode('[navigation_singlepage]'); ?>
    <?php do_shortcode('[simple_contact]'); ?>
</section>