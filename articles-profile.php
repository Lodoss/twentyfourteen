<?php
/**
 * The template for displaying articles Archives based on profile pages
 * By Ammar
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
/*
Template Name:Filter Article Archive
*/

get_header(); 
$profid = $_REQUEST["pid"];
//echo $profid;
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

$args = array(
  'post_type' => 'articles',
  'posts_per_page' => 10,
  'meta_query' => array(
  'relation' => 'AND',
	   array('key'     => '_wpcf_belongs_profile_id',
		'value'   => $profid,
		'compare' => '=')
  )
);

$books = new WP_Query($args);
?>
	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php if ( $books->have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title">
					<?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'twentyfourteen' ), get_the_date() );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyfourteen' ) ) );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentyfourteen' ) ) );

						else :
							_e( 'Articles Archives', 'twentyfourteen' );

						endif;
						wp_reset_postdata();
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
					// Start the Loop.
					//$args = array( 'post_type' => 'articles', 'posts_per_page' => 10 );
					//$loop = new WP_Query( $args );
					//var_dump($loop);
					while ( $books->have_posts() ) : $books->the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'content-articles', get_post_format() );

					endwhile;
					// Previous/next page navigation.
					twentyfourteen_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					//get_template_part( 'content-articles', 'none' );

				endif;
			?>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'articles' );
get_sidebar();
get_footer();
