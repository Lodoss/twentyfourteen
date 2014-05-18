<?php
/*
Template Name: Home-Page
*/
get_header(); ?>

    <div id="main-content" class="main-content">


        <div id="primary" class="content-area">
            <div id="content" class="site-content test" role="main">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; endif; ?>

            </div><!-- #content -->
        </div><!-- #primary -->
        <?php get_sidebar( 'content' ); ?>
    </div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
?>