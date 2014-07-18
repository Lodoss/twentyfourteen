<?php
/**
 * The Articles Sidebar
 * by Ammar
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( ! is_active_sidebar( 'sidebar-4' ) ) {
	return;
}
?>
<div id="article-sidebar" class="content-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-4' ); ?>
	<aside id="categories-3" class="widget widget_categories">
		<h1 class="widget-title">Article Categories</h1>
        <?php
			//list terms in a given taxonomy
			$taxonomy = 'article-cat';
			$tax_terms = get_terms($taxonomy);
			?>
			<ul>
			<?php
			foreach ($tax_terms as $tax_term) {
			echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
			}
			?>
			</ul>
         	</aside>
            <aside id="categories-3" class="widget widget_categories">
				<h1 class="widget-title">Authors</h1>
                <ul>
                <?php 
				 
				$profid = $_REQUEST["pid"];
				query_posts(array( 
						'post_type' => 'articles'
					) );  
				
				$profileList =  array();
				while (have_posts()) : the_post(); 
						  $profile = get_post_meta($post->ID, '_wpcf_belongs_profile_id', true);
						  if (!(empty( $profile ))) { 
						  	$profileList[] = $profile;
						  }
						  
						
				endwhile;
				wp_reset_postdata();
				$argsauthors = array('post_type' => 'profile',  'post__in' => $profileList );
				$the_query = new WP_Query( $argsauthors );
					
					
					
					
				// The Loop
				if ( $the_query->have_posts() ) {
					  
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						?>
								<li class="cat-item"><a href="<?php echo get_bloginfo('url') ?>/articles-profile/?pid=<?php echo get_the_ID() ?>" title=""><?php echo get_the_title(). " <br> ".get_post_meta( get_the_ID(), 'wpcf-profile-position', true ).""; ?></a></li>
					<?php
					}
				} else {
					//echo ' no posts found';
				}
				/* Restore original Post Data */
				wp_reset_postdata();
			  
			  
			  ?></ul>

            </aside>
</div><!-- #articles-sidebar -->
