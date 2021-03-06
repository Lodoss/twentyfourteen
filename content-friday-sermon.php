<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 * By Nabeel
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (is_single($post)){
				$youtubecode = types_render_field("youtube-embed", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
				$audiocode = types_render_field("download_audio", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
				$summary = types_render_field("enter-summary-or-text-url-here", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
				$sermondate = types_render_field("friday-sermon-date", array("argument1"=>"value1","argument2"=>"value2","argument2"=>"value2"));
				//$thumbnailyoutube = "http://img.youtube.com/vi/".$youtubecode."/hqdefault.jpg";
				echo ("<div style=\"text-align: center; margin: auto\"><object type=\"application/x-shockwave-flash\" style=\"width:100%; height:480px;\" data=\"http://www.youtube.com/v/".$youtubecode."?color2=FBE9EC&amp;version=3&amp;fs=1\">
			        <param name=\"movie\" value=\"http://www.youtube.com/v/".$youtubecode."?color2=FBE9EC&amp;version=3&amp;fs=1\" />
			        <param name=\"allowFullScreen\" value=\"true\" />
			        <param name=\"allowscriptaccess\" value=\"always\" />
        			</object>");
	}else{
	echo('<table id="friday-sermon">');
	echo('<tr>');
	echo('<td id="thumbnailcolumn">');
		twentyfourteen_post_thumbnail();
	echo('</td>');
	} ?>
	
	<td><header class="entry-header" style="margin-top:0px;">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentyfourteen_categorized_blog() ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>
		</div>
		<?php
			endif;
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
				
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
				$profile = get_post_meta($post->ID, '_wpcf_belongs_profile_id', true);
				if ($profile !=''){
					//var_dump($profile);
					echo(twentyfourteen_posted_on()."<br>");
					echo "<a href='".esc_url(get_permalink($profile))."'>".get_the_title($profile) . " <br> ".get_post_meta($profile,'wpcf-profile-position',TRUE). "</a> ";
				}
				else{
					//echo "NOT-HELLO";
				}
				//echo "<br>(".get_the_term_list( $post->ID, 'article-cat', '', ', ', '' ).")";
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() || is_archive() ) : ?>
	<div class="entry-summary">
		<?php //the_excerpt(); ?>
	</div><!-- .entry-summary -->
	</td>
	</tr>
	</table>
	<?php else : ?>
	<div class="entry-content">
		<?php
			if (is_single($post)){
				echo("<div>");
				echo ("<div style=\"padding:10px;border:2px solid gray;\">");
				echo get_post_meta($profile,'wpcf-profile-position',TRUE); 
				echo("<br>");
				echo get_post_meta($profile,'wpcf-short-description',TRUE);
				echo("<br>");
				echo get_the_post_thumbnail( $profile, 'twentyfourteen-author-box');
				echo ("</div>");
				echo ("<br>");
				echo ("</div>");


				echo "<strong>Download Audio:</strong> ".$audiocode."<br>";
				echo "<strong>Summary:</strong> ".$summary."<br>";
				echo "<strong>Date of the Friday Sermon:</strong> ".$sermondate."<br>";
			}else{
			//the_excerpt();
			}
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			
		?>
	</div>
	</td>
	</tr>
	</table><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->
