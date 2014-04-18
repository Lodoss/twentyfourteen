<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php twentyfourteen_post_thumbnail(); ?>

	<header class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentyfourteen_categorized_blog() ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>
		</div>
		<?php
			endif;

			if ( is_single() ) :
				if('friday-sermon' == get_post_type()){
				$youtubecode = types_render_field("youtube-embed", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
				$audiocode = types_render_field("download_audio", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
				$summary = types_render_field("enter-summary-or-text-url-here", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
				$sermondate = types_render_field("friday-sermon-date", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
				echo ("<div style=\"text-align: center; margin: auto\"><object type=\"application/x-shockwave-flash\" style=\"width:672px; height:360px;\" data=\"http://www.youtube.com/v/".$youtubecode."?color2=FBE9EC&amp;version=3&amp;fs=1\">
			        <param name=\"movie\" value=\"http://www.youtube.com/v/".$youtubecode."?color2=FBE9EC&amp;version=3&amp;fs=1\" />
			        <param name=\"allowFullScreen\" value=\"true\" />
			        <param name=\"allowscriptaccess\" value=\"always\" />
        			</object>");
				the_title( '<h1 class="entry-title">', '</h1>' );
				echo ("<img src=\"http://img.youtube.com/vi/".$youtubecode."/hqdefault.jpg\"/>");
				}else{
					the_title( '<h1 class="entry-title">', '</h1>' );
				}
				
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() )
					twentyfourteen_posted_on();

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyfourteen' ), __( '1 Comment', 'twentyfourteen' ), __( '% Comments', 'twentyfourteen' ) ); ?></span>
			<?php
				endif;

				edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() || is_home() || is_category()) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
		$profile = get_post_meta($post->ID, '_wpcf_belongs_profile_id', true);
		if ( 'post' == get_post_type() &&  $profile !=''){
		
		echo ("<div style=\"padding:10px;border:2px solid gray;\">");
		echo get_post_meta($profile,'wpcf-profile-position',TRUE); 
		echo("<br>");
		echo get_post_meta($profile,'wpcf-short-description',TRUE);
		echo("<br>");
		echo get_the_post_thumbnail( $profile, 'twentyfourteen-author-box');
		echo ("</div>");
		}else{
			if( 'friday-sermon' == get_post_type() &&  $profile !=''){

				echo("<div>");
				echo ("<div style=\"padding:10px;border:2px solid gray;\">");
				echo get_post_meta($profile,'wpcf-profile-position',TRUE); 
				echo("<br>");
				echo get_post_meta($profile,'wpcf-short-description',TRUE);
				echo("<br>");
				echo get_the_post_thumbnail( $profile, 'twentyfourteen-author-box');
				echo ("</div>");
				echo ("<br>");


				echo "<strong>Download Audio:</strong> ".$audiocode."<br>";
				echo "<strong>Summary:</strong> ".$summary."<br>";
				echo "<strong>Date of the Friday Sermon:</strong> ".$sermondate."<br>";

			}else{
				//empty for now
			}
		}
		if('profile' == get_post_type()){
					$position = types_render_field("profile-position", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
					$dateofbirth = types_render_field("date-of-birth", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
					$dateofdeath = types_render_field("date-of-death", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
					$mediumdesc = types_render_field("medium-description", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
					$shortdesc =  types_render_field("short-description", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
					echo "<strong>Position:</strong> ".$position."<br>";
					echo "<strong>Date of Birth:</strong> ".$dateofbirth."<br>";
					echo "<strong>Date of Death:</strong> ".$dateofdeath."<br>";
					echo "<strong>Description:</strong> ".$mediumdesc."<br>";
					echo "<strong>Short Description:</strong> ".$shortdesc."<br>";
		}
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->
