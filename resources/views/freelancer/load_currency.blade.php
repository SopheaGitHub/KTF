<?php

foreach ($data->data_budget_range as $key => $value) { 

    if($value->currency_id==1){ 
	?>
     <option value="<?php echo $value->budget_range_id; ?>">  <?php echo  '$'.$value->min .'- $'. $value->max; ?>
</option>
<?php  }else{    ?>
			<option value="<?php echo $value->budget_range_id; ?>">  <?php echo $value->min .'R -'. $value->max.'R'; ?>
</option>
  ?>  

<?php   
  }
	 }  
?>