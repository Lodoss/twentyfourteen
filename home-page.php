<?php
/*
Template Name: Home-Page
*/
get_header(); ?>

    <div id="featured-content" class="featured-content">
        <div class="featured-content-inner">
            <?php
            /**
             * Fires before the Twenty Fourteen featured content.
             *
             * @since Twenty Fourteen 1.0
             */
            do_action( 'twentyfourteen_featured_posts_before' );

            $featured_posts = twentyfourteen_get_featured_posts();
            foreach ( (array) $featured_posts as $order => $post ) :
                setup_postdata( $post );

                // Include the featured content template.
                get_template_part( 'content', 'featured-post' );







            endforeach;

            /**
             * Fires after the Twenty Fourteen featured content.
             *
             * @since Twenty Fourteen 1.0
             */
            do_action( 'twentyfourteen_featured_posts_after' );

            wp_reset_postdata();
            ?>
        </div><!-- .featured-content-inner -->
    </div><!-- #featured-content .featured-content -->



    <div id="main-content" class="main-content">


        <div id="primary" class="content-area">
            <div id="content" class="site-content test" role="main">

                <?php wp_reset_postdata(); if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; endif; wp_reset_postdata();?>

            </div><!-- #content -->
        </div><!-- #primary -->
        <?php get_sidebar( 'content' ); ?>
    </div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
?>