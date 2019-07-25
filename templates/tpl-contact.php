<?php 
/**
 * The template for displaying section contact on homepage
 * 
 * @package nautilusnet
 */

$page               = get_page_by_title('');
$page_id            = $page->ID;
$page_title         = $page->post_title;
$page_subtitle      = get_post_meta($page_id, 'subtitle_page', true);
$page_description   = $page->post_excerpt;
$page_content       = $page->post_content;
$page_thumb_url     = get_the_post_thumbnail_url($page);
?>
<section id="" class="container-fluid">
    <header class="sctHeader">
        <h1 class="sctHeader__title sctHeader__title--big" title=""><?php echo $page_title ?></h1>
        <p class="sctHeader__subtitle"><?php echo $page_content ?></p>
    </header>
    <?php 
    if( shortcode_exists('show_contact_section') ){
        do_shortcode('[show_contact_section]');
    }
    ?>
</section>