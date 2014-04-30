<?php
/**
 * The Articles Sidebar
 * by Ammar
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>
<div id="article-sidebar" class="content-sidebar widget-area" role="complementary">
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
</div><!-- #articles-sidebar -->
