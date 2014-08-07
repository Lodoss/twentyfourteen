<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
			$profileList =  array();
				// Start the Loop.
				while ( have_posts() ) : the_post();

		  ?>
          <a href="<?php echo  get_permalink( $profile ); ?>">

		  <?php
		  
					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content-events', get_post_format() );
					//echo  get_the_title($profile);
					

					// Previous/next post navigation.
					twentyfourteen_post_nav();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
				
				/**
				 * TODO: event date, translation for following and 2014 responsive shit
				 */
				
				$start = types_render_field("event-start-date", array("raw"=>"true"));
				$end 	 = types_render_field("event-end-date", array("raw"=>"true"));
				//$date 	= '10 September 2014, 10:00 AM';
				
				$street = types_render_field("address-street", array("raw"=>"true"));
				$zip 		= types_render_field("zip-code", array("raw"=>"true"));
				$city 	= types_render_field("city", array("raw"=>"true"));
				
				$poc 		= types_render_field("poc", array("raw"=>"true"));
				$tel 		= types_render_field("telephone-number", array("raw"=>"true"));
				$fax 		= types_render_field("fax-number", array("raw"=>"true"));
				$mail 	= types_render_field("poc-mail", array("raw"=>"true"));
				?>
				<div id="event-location" class="hentry entry-content">
					<div class="event-location-container">
						<div class="event-location-container-contact">
							<div class="event-location-content">
								<b>Start Date: </b><?php echo date_i18n('Y-m-d g:i:s A', $start) ?><br />
								<b>End Date: </b><?php echo date_i18n('Y-m-d g:i:s A', $end) ?><br /><br />
								
								<b>Address:</b><br />
								<?php echo $street; ?> <br /> <?php echo $zip; ?>, <?php echo $city; ?><br /><br />
								
								<b>Contact:</b><br />
								<?php echo $poc; ?><br />
								Telephone: <?php echo $tel; ?><br />
								Fax: <?php echo $fax; ?><br />
								Email: <?php echo $mail; ?><br />
							</div>
						</div>
						
						<div class="event-location-container-map">
						<?php
							// use this link for param http://wordpress.org/plugins/wp-flexible-map/installation/
								flexmap_show_map(array(
								  'address' => $street.', '.$zip.', '.$city,
								  'width' => '100%',
								  'height' => 350,
								  'zoom' => 14,
								  //'title' => 'Malik\'s Home',
								  //'description' => 'bla blaaa blaaaaaaaaa blaaaaaaaaaa.',
								  'directions' => 'event-directions',
								  'hidepanning' => 'true',
								  'hidescale' => 'false',
								  //'maptype' => 'satellite',
								));
						?>
					</div>
					<div id="event-directions"></div>
				</div>			
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php
get_sidebar( 'events' );
get_sidebar();
get_footer();
