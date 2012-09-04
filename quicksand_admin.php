<?php   
    if($_POST['quicksand_hidden'] == 'Y') {  
   
        $quicksand_category1 = $_POST['quicksand_category1'];  
        update_option('quicksand_category1', $quicksand_category1);  
          
        $quicksand_category2 = $_POST['quicksand_category2'];  
        update_option('quicksand_category2', $quicksand_category2);  
          
        $quicksand_category3 = $_POST['quicksand_category3'];  
        update_option('quicksand_category3', $quicksand_category3);  
          
        $quicksand_category4 = $_POST['quicksand_category4'];  
        update_option('quicksand_category4', $quicksand_category4);  
  
        $quicksand_category5 = $_POST['quicksand_category5'];  
        update_option('quicksand_category5', $quicksand_category5); 
		
		$include_jquery = $_POST['include_jquery'];
		update_option('include_jquery', $include_jquery); 
		
		$post_limit = $_POST['post_limit'];
		update_option('post_limit', $post_limit);
		
		if ($include_jquery['value'] == 't') { $jquery_text = 'and Jquery has been included' ;}

        ?>  
        <div class="updated"><p><strong><?php _e('Options saved ' . $jquery_text ); ?></strong></p></div>  
   
<?php   
   
        //Form data sent  
    } else {  
        //Normal page display 
	   $quicksand_category1 = get_option('quicksand_category1');
       $quicksand_category2 = get_option('quicksand_category2');	  
	   $quicksand_category3 = get_option('quicksand_category3');	  
	   $quicksand_category4 = get_option('quicksand_category4');	   
	   $quicksand_category5 = get_option('quicksand_category5');
	   $include_jquery = get_option('include_jquery');
	   $post_limit = get_option('post_limit');
	   
	    if ($include_jquery['value'] == 't' || $_POST['include_jquery'] == 'true' ) { $checked = 'checked="true"'; } else { $checked = ''; }
	   
    }  
?>

<div class="wrap">  
    <?php    echo "<h2>" . __( 'Quicksand Filter', 'quicksand_trdom' ) . "</h2>"; ?>  
      
    <form name="quicksand_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="quicksand_hidden" value="Y">  
        <?php    echo "<h4>" . __( 'Quicksand Filter Options', 'quicksand_trdom' ) . "</h4>"; ?>  

  		<p><?php _e("Category 1: " ); wp_dropdown_categories('show_option_none=Empty&name=quicksand_category1&id=quicksand_category1&selected=' . $quicksand_category1);?></p> 
        <p><?php _e("Category 2: " ); wp_dropdown_categories('show_option_none=Empty&name=quicksand_category2&id=quicksand_category2&selected=' . $quicksand_category2);?></p> 
        <p><?php _e("Category 3: " ); wp_dropdown_categories('show_option_none=Empty&name=quicksand_category3&id=quicksand_category3&selected=' . $quicksand_category3);?></p> 
        <p><?php _e("Category 4: " ); wp_dropdown_categories('show_option_none=Empty&name=quicksand_category4&id=quicksand_category4&selected=' . $quicksand_category4);?></p> 
        <p><?php _e("Category 5: " ); wp_dropdown_categories('show_option_none=Empty&name=quicksand_category5&id=quicksand_category5&selected=' . $quicksand_category5);?></p>  
        <p><?php _e("Include Jquery? " ); ?> <input type="checkbox" name="include_jquery" value="true" <?php echo $checked ?>/></p> 
        <p><?php _e("Post Limit: " ); ?> <input type="text" name="post_limit" value="<?php echo $post_limit; ?>" /> </p> 

		<hr />     
        <p class="submit">  
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'quicksand_trdom' ) ?>" />  
        </p>  
    </form>  
</div>  