<?php  

// Set Blank Variables for first use

$listall = '';
$featured = '';
$descriptions = '';
$titles = '';


    if(isset($_POST['quicksand_hidden'])) {  
   
        //Categories
        
		$categoriesloop = get_categories();
		$count = count($categoriesloop);
		
		for ($i = 1; $i <= $count; $i++) {
			$quicksand_category = $_POST['quicksand_category' .$i];  
                update_option('quicksand_category'.$i, $quicksand_category); 
		}
        
        //Descriptions on/off
        
        if (isset($_POST['descriptions'])) {
        
        if ($_POST['descriptions'] == 'yes') {
            $descriptions = 'yes';
        } 
        }else {
            $descriptions = 'no';
        }
        update_option('descriptions', $descriptions);
        
        //List All on/off
        
        if (isset($_POST['listall'])) {
            
            if ($_POST['listall'] == 'yes') {
                $listall = 'yes';

        }
        } else {
            $listall = 'no';
        }
        update_option('listall', $listall);
 
        // Use Post Featured Images
        
        if (isset($_POST['featured'])) {
            
            if ($_POST['featured'] == 'yes') {
                $featured = 'yes';

        }
        } else {
            $featured = 'no';
        }
        update_option('featured', $featured);        
        
         // Show Post Titles
        
        if (isset($_POST['titles'])) {
            
            if ($_POST['titles'] == 'yes') {
                $titles = 'yes';

        }
        } else {
            $titles = 'no';
        }
        update_option('titles', $titles);          	

        ?>  
        <div class="updated"><p><strong><?php _e('Options saved '); ?></strong></p></div>  
   
<?php   
   
        //Form data sent  
    } else {  
        //Normal page display 

           $descriptions = get_option('descriptions');
           $listall = get_option('listall');   
	   
    }  
?>

<div class="wrap">  
    <?php    echo "<h2>" . __( 'Quicksand Filter', 'quicksand_trdom' ) . "</h2>"; ?>  
      
    <form name="quicksand_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="quicksand_hidden" value="Y">  
        <?php    echo "<h4>" . __( 'Quicksand Filter Options', 'quicksand_trdom' ) . "</h4>"; ?> 
        <div class="category-options">
		<?php $categoriesloop = get_categories();
		$count = count($categoriesloop);
		
		for ($i = 1; $i <= $count; $i++) {
		$selected = get_option('quicksand_category' . $i); ?>
		
  		<p><?php _e("Category" . $i . ': ' ); wp_dropdown_categories('show_option_none=Empty&name=quicksand_category' . $i . '&id=quicksand_category' . $i . '&selected=' . $selected);?></p> 
		<?php } ?>
        </div>
        
        <p><?php _e("Category Descriptions: ");?> <input type="checkbox" name="descriptions" value="yes" <?php if ($descriptions == 'yes') { echo 'checked="checked"'; } else {};?>/> </p>
        <p><?php _e("List All Tab?:"); ?> <input type="checkbox" name="listall" value="yes" <?php if ($listall == 'yes') { echo 'checked="checked"';} else {} ?>/> </p>
        <p><?php _e("Use Post Featured Image:"); ?> <input type="checkbox" name="featured" value="yes" <?php if ($featured == 'yes') { echo 'checked="checked"';} else {} ?>/> </p>
        <p><?php _e("Show Post Titles:"); ?> <input type="checkbox" name="titles" value="yes" <?php if ($titles== 'yes') { echo 'checked="checked"';} else {} ?>/> </p>
        
		<hr />     
        <p class="submit">  
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'quicksand_trdom' ) ?>" />  
        </p>  
    </form>  
</div>  