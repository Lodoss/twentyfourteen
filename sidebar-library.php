<?php
/**
 * The Library Sidebar
 * by Ammar
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( ! is_active_sidebar( 'sidebar-6' ) ) {
	return;
}

?>
<div id="article-sidebar" class="content-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-6' ); 
	if(is_archive()){
	?>
	<aside id="categories-3" class="widget widget_categories">
		<h1 class="widget-title">Books Categories</h1>
        <?php
			//list terms in a given taxonomy
			$taxonomy = 'literature-type';
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
						'post_type' => 'library'
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
								<li class="cat-item"><a href="<?php echo get_bloginfo('url') ?>/library-profile/?pid=<?php echo get_the_ID() ?>" title=""><?php echo  get_the_title(). " (".get_post_meta( get_the_ID(), 'wpcf-profile-position', true ).")"; ?></a></li>
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
				
				$profile = get_post_meta(get_the_ID(), '_wpcf_belongs_profile_id', true);
				$author = get_post_meta(get_the_ID(), 'wpcf-author', true);
				wp_reset_postdata();
				//$argsauthors = array('post_type' => 'profile', 'id' => $profile );
				global $post;
				$post=get_post($profile);
				//$the_query = new WP_Query( $argsauthors );
				$child_posts = types_child_posts('library');
					
				?>
                <h1 class="widget-title">More by <a href="<?php echo get_bloginfo('url') ?>/library-profile/?pid=<?php echo $profile; ?>" title=""><?php echo  get_the_title(); ?></a></h1>
                <ul>
                <?	
					
					
				// The Loop
				if ( $child_posts->have_posts() ) {
					foreach ($child_posts as $child_post) {
						echo '<li><a href="'.get_permalink($child_post->ID).'">'.get_the_title($child_post->ID).'</a></li>';
					  }	  
				}
				/* Restore original Post Data */
				wp_reset_postdata();
			?>
            </ul>
            </aside> <?
}
?>
</div><!-- #library-sidebar -->

