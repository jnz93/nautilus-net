<?php 
/**
 * The template for displaying section plans on homepage
 * 
 * @package nautilusnet
 */

$page               = get_post('662');
$page_id            = $page->ID;
$page_title         = $page->post_title;
$page_subtitle      = get_post_meta($page_id, 'subtitle_page', true);
$page_description   = $page->post_excerpt;
$page_content       = $page->post_content;
$page_thumb_url     = get_the_post_thumbnail_url($page);
?>
<section id="" class="container-fluid">
    <header class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sctHeader">
        <h1 class="sctHeader__title sctHeader__title--big" title=""><?php echo $page_title ?></h1>
        <p class="sctHeader__subtitle"><?php echo $page_content ?></p>
    </header>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sctContentWrapper">
        <?php 
        if( shortcode_exists('show_plans') ){
            do_shortcode('[show_plans]');
        }else{
            echo "O shortcode de beneficios não existe.";
        }
        ?>
    </div>
</section>