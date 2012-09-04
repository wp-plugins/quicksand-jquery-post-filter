<?php
/*
Plugin Name: Quicksand
Plugin URI: http://www.developingtheweb.co.uk/plugins/quicksand-wordpress-plugin/
Description: Use the Jquery Quicksand to filter posts by categories.
Author: Mark Stockton
Version: 1
Author URI: http://www.developingtheweb.co.uk
*/

  function quicksandfiles() {	 
	  
    wp_enqueue_script( 'jquery' );

    wp_register_script( 'main', plugins_url('quicksand/js/main.js', dirname(__FILE__)));
    wp_enqueue_script( 'main' );
	
	wp_register_script( 'quicksand', plugins_url('quicksand/js/jquery.quicksand.js', dirname(__FILE__)));
    wp_enqueue_script( 'quicksand' );
	
	wp_register_script( 'easing', plugins_url('quicksand/js/jquery.easing.1.3.js', dirname(__FILE__)));
    wp_enqueue_script( 'easing' );
	
	wp_register_style('layout', plugins_url('quicksand/css/layout.css', dirname(__FILE__)));
	wp_enqueue_style('layout');	
	?>  
 
<?php   }
add_action('wp_enqueue_scripts', 'quicksandfiles');

  function quicksand()
  {
static $quicksand_result;

if ($quicksand_result !== NULL)
return $quicksand_result;
	  
	   $quicksand_category1 = get_option('quicksand_category1');
       $quicksand_category2 = get_option('quicksand_category2');
	   $quicksand_category3 = get_option('quicksand_category3');
	   $quicksand_category4 = get_option('quicksand_category4');
	   $quicksand_category5 = get_option('quicksand_category5'); 
	
	   $quicksand_categories = array($quicksand_category1, $quicksand_category2, $quicksand_category3, $quicksand_category4, $quicksand_category5);
	   
?>
<ul id="filterOptions">
    <li><a href="#" class="all">All</a></li>   
    <?php foreach ($quicksand_categories as $catID) {
		if ($catID < 0) {break;  } else { $filter_category = get_cat_name($catID); }
		?>
    <li><a href="#" class="<?php echo $filter_category; ?>"><?php echo $filter_category; ?></a></li>
 <?php } ?>   
</ul>  
  
  <ul class="ourHolder">
<?php

$limit = get_option('post_limit');


 global $post;
 $args = array('numberposts' => $limit, 'category' => $quicksand_category1, 'category' => $quicksand_category2, 'category' => $quicksand_category3, 'category' => $quicksand_category4, 'category' => $quicksand_category5);
 $myposts = get_posts( $args );
 foreach( $myposts as $post ) : setup_postdata($post);
        $categories = get_the_category();

        $category = $categories[0]->cat_name;

?>
<li class="item" data-id="id-<?php the_ID() ?>" data-type="<?php echo $category; ?>">
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(100,100)) ;?><br />
<?php  the_title();?></a></li>
<?php  endforeach; 
wp_reset_query(); ?>
</ul>

<?php  
$quicksand_result = TRUE;
return $quicksand_result; 
 
  }  
// set admin menu link and include admin page 
if ( is_admin() ){
add_action('admin_menu', 'quicksand_admin_actions');
function quicksand_admin() {
include 'quicksand_admin.php';
}

function quicksand_admin_actions() {
add_options_page('QuicksandFilter', 'QuicksandFilter', 'manage_options', 'QuicksandFilter', 'quicksand_admin');
	}
}

add_shortcode( 'quicksand', 'quicksand' );

