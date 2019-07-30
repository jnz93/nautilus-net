<?php 
/**
 * The template for displaying section contact on homepage
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
<section id="contact" class="container-fluid sct__contact">
    <header class="row sctHeader">
        <h1 class="sctHeader__title sctHeader__title--big" title=""><?php echo sanitize_text_field($page_title) ?></h1>
        <p class="sctHeader__subtitle"><?php echo sanitize_text_field($page_content) ?></p>
    </header>

    <div class="container-fluid row sct__contentWrapper">
        <?php 
        if( shortcode_exists('show_contact_section') ){
            do_shortcode('[show_contact_section]');
        }
    ?>
    </div>
</section>