<?php
/*
Plugin Name: Quicksand
Plugin URI: http://www.developingtheweb.co.uk/plugins/quicksand-wordpress-plugin/
Description: Use the Jquery Quicksand to filter posts by categories.
Author: Mark Stockton
Version: 2.1
Tags: jQuery post filter, posts filter, quicksand filter, category filter
Author URI: http://www.developingtheweb.co.uk
*/
?>
<?php
          require plugin_dir_path( __FILE__ ) . '/quicksand_functions.php';

          quicksand_add_actions();
