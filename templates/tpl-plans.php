<?php 
/**
 * The template for displaying section plans on homepage
 * 
 * @package nautilusnet
 */

// $page               = get_page_by_title('Temos vários planos de conexão para você e sua família');
$page               = get_post('662');
$page_id            = $page->ID;
$page_title         = $page->post_title;
$page_subtitle      = get_post_meta($page_id, 'subtitle_page', true);
$page_description   = $page->post_excerpt;
$page_content       = $page->post_content;
$page_thumb_url     = get_the_post_thumbnail_url($page);
?>
<section id="planos" class="container-fluid sct__plans">
    <header class="row sctHeader">
        <h1 class="sctHeader__title sctHeader__title--big" title=""><?php echo sanitize_text_field($page_title); ?></h1>
        <p class="sctHeader__subtitle"><?php echo sanitize_text_field($page_content); ?></p>
    </header>

    <div class="container-fluid row sct__contentWrapper">
        <?php 
        if( shortcode_exists('show_plans') ){
            do_shortcode('[show_plans]');
        }else{
            echo "O shortcode de beneficios não existe.";
        }
        ?>
    </div>
</section>