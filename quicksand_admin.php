<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    quicksand_form_reader();
?>



<div class="wrap">  
    <?php    echo "<h2>" . __( 'Quicksand Filter', 'quicksand_trdom' ) . "</h2>"; ?>  
      
    <form name="quicksand_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">          
        
        
        <div class="category-selector">
            <?php quicksand_category_selector(); ?>
        </div>
        
        
        <?php
             $descriptions = get_option('descriptions');
             $listall = get_option('listall');
             $featured = get_option('featured');
             $titles = get_option('titles');
            
        ?>
        <div class="options-selector">
                <p><?php _e("Category Descriptions: ");?> <input type="checkbox" name="descriptions" value="yes" <?php if ($descriptions == 'yes') { echo 'checked="checked"'; } else {};?> /> </p>
                <p><?php _e("List All Tab?:"); ?> <input type="checkbox" name="listall" value="yes" <?php if ($listall == 'yes') { echo 'checked="checked"';} else {} ?> /> </p>
                <p><?php _e("Use Post Featured Image:"); ?> <input type="checkbox" name="featured" value="yes" <?php if ($featured == 'yes') { echo 'checked="checked"';} else {} ?> /> </p>
                <p><?php _e("Show Post Titles:"); ?> <input type="checkbox" name="titles" value="yes" <?php if ($titles== 'yes') { echo 'checked="checked"';} else {} ?>/> </p>   
        </div>
        <p class="submit">  
            <input type="submit" class="quicksand-submit" name="Submit" value="<?php _e('Update Options', 'quicksand_trdom' ) ?>" />  
        </p>         
    </form>
</div>