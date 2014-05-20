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

            /*
             *
             *  Latest friday sermon sticky featured post
             */

//WordPress loop for custom post type
 $my_query = new WP_Query('post_type=friday-sermon&posts_per_page=1');
      while ($my_query->have_posts()) : $my_query->the_post(); ?>

          <!--Do Stuff-->

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <a class="post-thumbnail" href="<?php the_permalink(); ?>">
                  <?php
                  // Output the featured image.
                  if ( has_post_thumbnail() ) :
                      if ( 'grid' == get_theme_mod( 'featured_content_layout' ) ) {
                          the_post_thumbnail();
                      } else {
                          the_post_thumbnail( 'twentyfourteen-full-width' );
                      }
                  endif;
                  ?>
              </a>

              <header class="entry-header">
                  <?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentyfourteen_categorized_blog() ) : ?>
                      <div class="entry-meta">
                          <span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>
                      </div><!-- .entry-meta -->
                  <?php endif; ?>

                  <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h1>' ); ?>
              </header><!-- .entry-header -->
          </article><!-- #post-## -->
      <?php endwhile;  wp_reset_query(); ?>


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