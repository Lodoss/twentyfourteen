<?php
/**
 * The Content Sidebar
 * by Nabeel
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( ! is_active_sidebar( 'sidebar-5' ) ) {
	return;
}
?>
<div id="content-sidebar" class="content-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-5' ); ?>
</div><!-- #content-sidebar -->
<!--<div id="content-sidebar" class="content-sidebar widget-area" role="complementary">
<aside id="categories-3" class="widget widget_categories">
	<h1 class="widget-title">Friday Sermon by Year</h1>
	<?php wp_get_archives(array( 'type' => 'yearly')); ?>
</aside>
</div>--><!-- #content-sidebar -->
