<?php

//Admin Functions   
   
   // Add Admin Stylesheet
   function quicksand_admin_style() {
       /* Register our stylesheet. */
       wp_register_style( 'quicksand_admin_style', plugins_url('/css/quicksand_admin.css', __FILE__) );
   }  
   
   add_action( 'admin_init', 'quicksand_admin_style' );
   
   function quicksand_add_actions() {
          
           add_action('wp_enqueue_scripts', 'quicksandfiles');
          
           
            // Add Admin Menu 

               if ( is_admin() ){
                   add_action('admin_menu', 'quicksand_admin_actions');
                   function quicksand_admin() {
                       include 'quicksand_admin.php';
                       wp_enqueue_style('quicksand_admin_style'); 
               }

               function quicksand_admin_actions() {
                           add_options_page('QuicksandFilter', 'QuicksandFilter', 'manage_options', 'QuicksandFilter', 'quicksand_admin');
                       }
               }          
      }
        
      
    // Update Individual Options   
    function quicksand_options_update($name,$option) {
        
        if (isset($option)) {
            update_option($name, $option);
        }
        else {
        }
    }
    
    // Read and Set Post Variables
    
    function quicksand_form_reader() {  

        $postVariables = array();
        
        foreach ($_POST as $key => $value) {
            $optionArray = array ('name' => $key, 'value' => $value); 
            if ($key == 'Submit') {
                
            } else {
            $postVariables[] = $optionArray;
            }
        }

        //Run Update on Post Array

        foreach ($postVariables as $runOption) {
            
            if ($runOption['value'] == 'Empty') {
                delete_option($runOption['name']);
            } else {
            
            quicksand_options_update($runOption['name'], $runOption['value']);
            }
        }

    
    }
    
    //js script for adding new category options
    
    function quicksand_category_selector() {
        $categorySelect = get_categories();
        $all_options = wp_load_alloptions();        
        
?>        
        <script>
                jQuery(function() {
                        var quicksandDiv = jQuery('#add_categories');
                        
                       // var i = parseInt(jQuery('#category-label').parent().attr('id')) + 1;

                     var arr = [];
                     
                     jQuery("#add_categories p").each(function() {
                         var value = parseInt(jQuery(this).attr('id'));
                         arr.push(value);
                     })
                     
                     var largest = Math.max.apply(null,arr);                    
                     var i = largest + 1;
                     
                        jQuery('#addCategory').live('click', function() {
                                jQuery('<p id="' + i + '"><label for="category"><select id="quicksand_category' + i +  '" name="quicksand_category' + i +'"><?php foreach ($categorySelect as $c) { echo '<option value="' . $c->cat_ID . '"' .  '>' . $c->cat_name . '</option>'; }?><option value="Empty">Empty</option></select></label> </p>').appendTo(quicksandDiv);
                                i++;
                                return false;
                        });

                        jQuery('#remove').live('click', function() { 
                                if( i > 2 ) {
                                        jQuery(this).parents('p').remove();
                                        i--;
                                }
                                return false;
                        });
                });       
        </script>
        
        
                <div id="add_categories">
                <p id="0">&nbsp</p>
<?php   
  
    // Get Current Added Categories
              foreach ($all_options as $name => $key) {
                           $shortname = mb_substr($name, 0, 18);
                            if ($shortname == "quicksand_category") {    
                                ?>
        <p id="<?php echo substr($name, -1); ?>">
            <label for="category">
                <select id="<?php echo $name;?>" name="<?php echo $name;?>">
                     <?php foreach ($categorySelect as $c) { 
                            echo '<option value="' . $c->cat_ID . '"';
                            if ($key == $c->cat_ID) {
                                    echo ' selected';
                                }
                            echo '>' . $c->cat_name . '</option>'; }
                            
                            ?>
                <option value="Empty">Empty</option>
                </select>
            </label>
<!--            <a href="#" id="remove">Remove</a>-->
        </p>
        
<?php
                            } else {
                                
                            }
                    } ?>
                </div> 
        <h3><a href="#" id="addCategory" class="add-category">New Filter</a></h3>
<?php        
        }

//Front End Functions
        
        //Include scripts and styles
        function quicksandfiles() {	 

           wp_enqueue_script( 'jquery' );

           wp_register_script( 'easing', plugins_url('quicksand-jquery-post-filter/js/jquery.easing.1.3.js', dirname(__FILE__)));
           wp_enqueue_script( 'easing' );
           
           wp_register_script( 'quicksand', plugins_url('quicksand-jquery-post-filter/js/jquery.quicksand.js', dirname(__FILE__)));
           wp_enqueue_script( 'quicksand' );
           
           wp_register_script( 'main', plugins_url('quicksand-jquery-post-filter/js/main.js', dirname(__FILE__)));
           wp_enqueue_script( 'main' );

           wp_register_style('layout', plugins_url('quicksand-jquery-post-filter/css/layout.css', dirname(__FILE__)));
           wp_enqueue_style('layout');	

          }        
        

        // Front End Quicksand Display
        
        function quicksand() {  
          
 	   // $categoriesloop = get_categories();
	//	$count = count($categoriesloop);
                $count = 100;
		for ($i = 1; $i <= $count; $i++) {

			   $quicksand_categories[] = get_option('quicksand_category' . $i); 
		}
	   array_push($quicksand_categories, 0);   

           
?>
        <div class="options-container">
                <ul id="filterOptions">
                    <?php $cat_descriptions = array(); ?>

                    <?php if (get_option('listall') == 'yes') { ?>
                    <li><a href="#" class="all">All</a></li>   
                    <?php } ?>

                        <?php foreach ($quicksand_categories as $catID) {
                                if ($catID == 0) { } else { $filter_category = get_cat_name($catID); 
                                ?>
                    <li><a href="#" class="<?php echo $catID; ?>"><?php echo $filter_category; ?></a></li>
                    <?php $cat_descriptions[$catID] = category_description($catID); ?>
                 <?php } } ?>   
                </ul>
                </div>

                <?php if (get_option('descriptions') == 'yes') { ?> 
                <div class="descriptions">
                        <?php foreach ($cat_descriptions as $key => $val) { ?>
                                <h3 class='category-description' cat-id='<?php echo $key . "'"; if ($key != 7) {?> style = 'display:none;'<?php } ?> >
                                    <?php echo $cat_descriptions[$key]; ?>
                                </h3>
                        <?php } ?>
                </div>
<?php } ?>
             <ul class="ourHolder">         

<?php                                                     
                     $args = array(
                                    'posts_per_page' => '-1',
                                    'post_type' => 'post',
                                    'post_status' => 'publish',
                                    'category__in' => $quicksand_categories 
                                    );
                     
                    $query = new WP_Query( $args );
                    
                    foreach ($query->posts as $item) {
                        
                        $categories = wp_get_post_categories($item->ID);
 ?>
                        <li id="item" class="item" data-id="id-<?php echo $item->ID ?>" data-type="<?php foreach ($categories as $c) { echo $c . ' ';}?>" >
                        <?php  if (get_option('featured') == 'yes') { ?>
                           <a href="<?php echo get_permalink($item->ID); ?>">
                        <?php  echo get_the_post_thumbnail($item->ID,array(100,100));  ?></a>
                        <?php } ?>
                           <br />
                        <?php if(get_option('titles') == 'yes') { ?>
                            <a href="<?php echo get_permalink($item->ID); ?>">
                        <?php echo get_the_title($item->ID); ?>
                            </a>
                            <?php } ?>
                        </li>                                          
                    <?php  }  ?>
             </ul><?php echo get_option('quicksand_category9'); ?>
<?php            
        }
        // Include shortcode call
        add_shortcode( 'quicksand', 'quicksand' );       
        ?>
