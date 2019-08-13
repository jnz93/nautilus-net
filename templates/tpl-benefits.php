<?php 
/**
 * The template for displaying section benefits on homepage
 * 
 * @package nautilusnet
 */

// $page               = get_page_by_title('Conheça as vantages da Nautilus Net');
$page               = get_post('662');
$page_id            = $page->ID;
$page_title         = $page->post_title;
$page_subtitle      = get_post_meta($page_id, 'subtitle_page', true);
$page_description   = $page->post_excerpt;
$page_content       = $page->post_content;
$page_thumb_url     = get_the_post_thumbnail_url($page);
?>
<section id="benefits" data-wow-delay=".1s" class="wow fadeIn container-fluid sct__benefits">
    <header class="row sctHeader">
        <h1 class="sctHeader__title sctHeader__title--big" title="" style="display: block"><?php echo $page_title ?></h1>
        <p class="sctHeader__subtitle"><?php echo sanitize_text_field($page_content);?></p>
    </header>

    <div class="row col-lg-10 sct__contentWrapper">
        <?php 
        if( shortcode_exists('show_article_benefits') ){
            do_shortcode('[show_article_benefits]');
        }else{
            echo "O shortcode de beneficios não existe.";
        }
        ?>
    </div>
</section>