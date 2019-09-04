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
            <main id="main" class="content__main col-lg-8" role="main">
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post(); ?>
                    <div class="post">
                        <h1 class="post__title"><?php the_title(); ?></h1>
                        <p class="post__excerpt"><?php echo get_the_excerpt() ?></p>

                        <div class="postData">
                            <!-- Author -->
                            <!-- data da publicação -->
                            <!-- Tempo de leitura -->
                        </div>

                        <?php the_content(); ?>
                    </div><!-- .content-post -->

                <?php
                // End the loop.
                endwhile;
                ?>
    
            </main><!-- .content__main -->

            <aside class="content__aside col-lg-4">

            </aside><!-- .content__aside --> 
        </div>
        
    </div><!-- .content -->
 
<?php get_footer(); ?>