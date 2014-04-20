<?php
/**
 * The Content Sidebar
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>
<div id="content-sidebar" class="content-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
	<?php if('friday-sermon' == get_post_type()){
		//fetch meta content from current page.
		//$profile = get_post_meta(get_the_ID(), '_wpcf_belongs_profile_id', true);
		//$audio = get_post_meta($postID,'download_audio',TRUE);
		?>
	<a href="<?php $audio ?>">Download Audio</a><br>
	<a href="#">Read Summary</a>

	<?php }?>
</div><!-- #content-sidebar -->
