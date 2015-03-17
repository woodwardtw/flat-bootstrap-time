<?php
/**
 * Theme: Flat Bootstrap
 * 
 * Template Name: Page - Full Width by Time
 *
 * Full width page template (no sidebar, no container) with 3 columns of recent posts
 *
 * This is the template for full width pages with no sidebar and no container. It also
 * lists your 3 most recent posts. This page truly stretches the full width of the 
 * browser window. You should set a <div class="container"> before your content to keep 
 * it in line with the rest of the site content.
 *
 * @package flat-bootstrap
 */

get_header(); ?>

<?php get_template_part( 'content', 'header' ); ?>

<div id="primary" class="content-area-wide">
	<main id="main" class="site-main" role="main">
        <?php 
        /* The loop: the_post retrieves the content
         * of the new Page you created to list the posts,
         * e.g., an intro describing the posts shown listed on this Page..
         */
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();

              // Display content of page
              get_template_part( 'content', 'page-fullwidth'); 
              wp_reset_postdata();
  
            endwhile;
        endif;

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
       
       //gets the time and splits it up into pieces
         $blogtime = current_time( 'mysql' ); 
        list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = split( '([^0-9])', $blogtime );
        $now = $today_year . '-' . $today_month . '-' . $today_day;
        
        

        $args = array(
            // Change these category SLUGS or date paremeters to suit your use.
            'category_name' => 'event', 
            'paged' => $paged,
            'meta_value' => $now,
        );

        $list_of_posts = new WP_Query( $args );        
?>

        
<!--This was just some testing stuff <?php 
                echo $today_year . '-' . $today_month . '-' . ($today_day+3) . ' blogtime <br />';
         ?>
         <?php $meta_values = get_post_meta( 45, 'event', $single ); 
         echo $meta_values;
         ?>-->

   
        <?php if ( $list_of_posts->have_posts() ) :
      /*  echo "Search found ".$list_of_posts->found_posts." results"; */
        $countposts = $list_of_posts->found_posts;
     /*   echo "<br />countposts=". $countposts; */
?>
			<?php /* The loop */?>
			<?php while ( $list_of_posts->have_posts() ) : $list_of_posts->the_post();?>
			
				<?php // Display content of posts ?>
				<?php 
				if ($countposts>1){
				 get_template_part( 'content', 'page-posties' , 'page-nav'); 
				}
				else
				{
				 get_template_part( 'content', 'page-posty', 'page-nav' );
				}
				?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
		<div class="nada">
            There are no events today. Maybe you'd like to plan something for the future?
            </div>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>