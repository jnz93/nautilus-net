<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Nautilusnet
 * @since Nautilusnet 1.2.0
 */
 
get_header(); ?>
 
    <div id="primary" class="content">

        <div class="content__cover" style="background-image: url('<?php the_post_thumbnail_url('full'); ?>')">
        </div><!-- .content__cover -->

        <div class="content__wrapperMain">
            <?php do_shortcode('[widget_share_post]'); ?><!-- .sharePost -->

            <main id="main" class="content__main col-xs-11 col-sm-11 col-md-8 col-lg-8" role="main">
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post(); ?>
                    <div class="post">
                        <h1 class="post__title"><?php the_title(); ?></h1>
                        <p class="post__excerpt"><?php echo get_the_excerpt() ?></p>

                        <div class="post__informations col-lg-12">
                            <!-- Author -->
                            <span class="post__data"> <i class="post__icon" data-eva="person"></i> <?php the_author() ?></span>
                            <!-- data da publicação -->
                            <span class="post__data"><i class="post__icon" data-eva="calendar"></i> <?php the_time(get_option('date_format'));?> </span>
                            <!-- Tempo de leitura -->
                            <span class="post__data"><i class="post__icon" data-eva="book-open"></i></span>
                        </div>

                        <?php the_content(); ?>
                    </div><!-- .content-post -->

                <?php
                // End the loop.
                endwhile;
                ?>
    
            </main><!-- .content__main -->

            <aside class="content__aside col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="asideBox col-xs-12 col-sm-12 col-md-11 col-lg-11">

                    <div class="asideBox__adsense">
                        <?php do_shortcode('[widget_adsense]'); ?><!-- Adsense -->
                    </div>

                    <div class="asideBox__lastPosts">
                        <?php do_shortcode('[similar_posts_aside]'); ?><!-- Outras publciações -->
                    </div>

                    <div class="asideBox__socialNetwork">                        
                        <?php do_shortcode('[widget_social_network]'); ?><!-- Redes sociais -->
                    </div>
                </div>
            </aside><!-- .content__aside --> 
        </div>
        
    </div><!-- .content -->
 
<?php get_footer(); ?>