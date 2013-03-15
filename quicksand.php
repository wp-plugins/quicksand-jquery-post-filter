<?php
/*
Plugin Name: Quicksand
Plugin URI: http://www.developingtheweb.co.uk/plugins/quicksand-wordpress-plugin/
Description: Use the Jquery Quicksand to filter posts by categories.
Author: Mark Stockton
Version: 1.7.2
Author URI: http://www.developingtheweb.co.uk
*/

  function quicksandfiles() {	 
	  
    wp_enqueue_script( 'jquery' );

    wp_register_script( 'main', plugins_url('quicksand-jquery-post-filter/js/main.js', dirname(__FILE__)));
    wp_enqueue_script( 'main' );
	
    wp_register_script( 'quicksand', plugins_url('quicksand-jquery-post-filter/js/jquery.quicksand.js', dirname(__FILE__)));
    wp_enqueue_script( 'quicksand' );
	
    wp_register_script( 'easing', plugins_url('quicksand-jquery-post-filter/js/jquery.easing.1.3.js', dirname(__FILE__)));
    wp_enqueue_script( 'easing' );
	
    wp_register_style('layout', plugins_url('quicksand-jquery-post-filter/css/layout.css', dirname(__FILE__)));
    wp_enqueue_style('layout');	
	?>  
 
<?php   }
add_action('wp_enqueue_scripts', 'quicksandfiles');

  function quicksand()
  {	  
	    $categoriesloop = get_categories();
		$count = count($categoriesloop);	
		for ($i = 1; $i <= $count; $i++) {

			   $quicksand_categories[] = get_option('quicksand_category' . $i); 
		}
	    array_push($quicksand_categories, '-1');
	   
?>
<div class="options-container">
<ul id="filterOptions">
    <?php $cat_descriptions = array(); ?>

    <?php if (get_option('listall') == 'yes') { ?>
    <li><a href="#" class="all">All</a></li>   
    <?php } ?>
        
        <?php foreach ($quicksand_categories as $catID) {
		if ($catID < 0) {break;  } else { $filter_category = get_cat_name($catID); }
		?>
    <li><a href="#" class="<?php echo $catID; ?>"><?php echo $filter_category; ?></a></li>
    <?php $cat_descriptions[$catID] = category_description($catID); ?>
 <?php } ?>   
</ul>
</div>

<?php if (get_option('descriptions') == 'yes') { ?> 
<div class="descriptions">
    	<?php foreach ($cat_descriptions as $key => $val) { ?>
		<h3 class='category-description' cat-id='<?php echo $key . "'"; if ($key != 7) {?> style = 'display:none;'<?php } ?> > <?php echo $cat_descriptions[$key]; ?></h3>
	<?php } ?>
</div>
<?php } ?>
  <ul class="ourHolder">
<?php
 
 global $post;
 
 $args = array(
     'numberposts' => '-1'
     );
 
 $myposts = get_posts($args);
 
 foreach( $myposts as $post ) : setup_postdata($post);
        $postCategories = wp_get_post_categories($post->ID);
        $categories = array();
        foreach($postCategories as $category) {
        $category = get_category($category);
        $categories[] = array('id' => $category->term_id);
        }

?>     
      
<?php 

foreach ($categories as $c) {
if (in_array( $c['id'], $quicksand_categories)) { ?>     
      
<li id="item" class="item" data-id="id-<?php the_ID() ?>" data-type="<?php foreach ($categories as $c) { echo $c['id'] . ' ';}?>" >
 <?php 
    if (get_option('featured') == 'yes') {
 ?>
    <a href="<?php the_permalink(); ?>">
 <?php       
 the_post_thumbnail(array(100,100));
 ?></a>
    <?php
    }?>
    <br />
    
<?php

    if(get_option('titles') == 'yes') {
        ?>
    <a href="<?php the_permalink(); ?>">
<?php        
    the_title();
    ?>
    </a>
    <?php
    }
 ?></li>
<?php
    }
}
endforeach; 
wp_reset_query(); ?>
</ul>

<?php  
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

