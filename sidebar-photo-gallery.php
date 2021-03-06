<?php
/**
 * The photo-gallery Sidebar
 * by Ammar
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( ! is_active_sidebar( 'sidebar-7' ) ) {
	return;
}

?>
<div id="article-sidebar" class="content-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-7' ); 
	if(is_archive()){
	?>
	<aside id="categories-3" class="widget widget_categories">
		<h1 class="widget-title">Gallery Categories</h1>
        <?php
			//list terms in a given taxonomy
			$taxonomy = 'gallery-cat';
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
				<h1 class="widget-title">In this Gallery</h1>
                <ul>
                <?php 
				 
				$profid = $_REQUEST["pid"];
				query_posts(array( 
						'post_type' => 'photo-gallery'
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
								<li class="cat-item"><a href="<?php echo get_bloginfo('url') ?>/photo-gallery-profile/?pid=<?php echo get_the_ID() ?>" title=""><?php echo get_the_title(). " <br> ".get_post_meta( get_the_ID(), 'wpcf-profile-position', true ).""; ?></a></li>
					<?php
					}
				} else {
					//echo ' no posts found';
				}
				/* Restore original Post Data */
				wp_reset_postdata();
			  
			  
			  ?></ul>

            </aside>
            <?php
}
else
{ ?>
	<aside id="categories-3" class="widget widget_categories">
		
        <?php
				
				/*
				$profileList =  array();
				while (have_posts()) : the_post(); 
						  $profile = get_post_meta($post->ID, '_wpcf_belongs_profile_id', true);
						  if (!(empty( $profile ))) { 
						  	$profileList[] = $profile;
						  }
						  
						
				endwhile;*/
				$currentId = get_the_ID();
				$profile = get_post_meta(get_the_ID(), '_wpcf_belongs_profile_id', true);
				$author = get_post_meta(get_the_ID(), 'wpcf-author', true);
				wp_reset_postdata();
				//$argsIn this Gallery = array('post_type' => 'profile', 'id' => $profile );
				global $post;
				$post=get_post($profile);
				//$the_query = new WP_Query( $argsIn this Gallery );
				$child_posts = types_child_posts('photo-gallery');
					
				?>
                <h1 class="widget-title">More by <a href="<?php echo get_bloginfo('url') ?>/photo-gallery-profile/?pid=<?php echo $profile; ?>" title=""><?php echo  get_the_title(); ?></a></h1>
                <ul>
                <?	
					
					
				// The Loop
				
					foreach ($child_posts as $child_post) {
						if($child_post->ID != $currentId){
						
							echo '<li>';
							if(has_post_thumbnail($child_post->ID)){
								echo get_the_post_thumbnail($child_post->ID,'twentyfourteen-related-sidebar-width'). "<br style='padding-bottom:10px' />";
							}
							echo'<a href="'.get_permalink($child_post->ID).'">'.get_the_title($child_post->ID).'</a></li>';
						}
					  }	  
				
				/* Restore original Post Data */
				wp_reset_postdata();
			?>
            </ul>
            </aside> <?
}
?>
</div><!-- #photo-gallery-sidebar -->

