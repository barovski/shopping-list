<?php 
echo doctype();
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $meta = array(
    array('name' => 'robots', 'content' => 'no-cache'),
    array('name' => 'description', 'content' =>  $this->config->item('Site_description')),
    array('name' => 'keywords', 'content' =>  $this->config->item('Site_keywords')),
    array('name' => 'robots', 'content' => 'no-cache'),
    array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')         
                            );
	echo meta($meta); ?>
    <title><?php echo $this->config->item('Site_title');?></title>
<?php echo link_tag('public/css/reset.css'); ?>
    
<?php echo link_tag('public/css/site.css'); ?>


                
</head>
           
                  	
	           
           
    
                    <body>
                 
   
                        
                             
                        <div class="header">
                            <div class="menu">
                                <ul>
                                    
                                    <li><?php echo anchor(base_url(),'Home')?></li>
                                    <li><?php echo anchor(base_url('shopping_list/add'),'+ Add list','class="active"')?></li>
                                    <li><?php echo anchor(base_url('logout'),'Logout')?></li>
                                </ul>
                                
                            </div>
                            
                        </div>
                        
                        <div id="main_container">
                            <div class="content_p">
                                
                                
                                <div class="cont">
                                    <div class="head_title">
                                        <h1>Add new shopping list</h1> 
                                </div>
                                <?php
                                       $attributes= array(
                                           'id'=>'settings_form'
                                       );
                                       echo form_open(base_url().'shopping_list/add', $attributes);
                                       ?>
                                    
                                   
                                    
                                     
                                <h1>Shopping list name</h1><p class="error"><?php echo form_error('list_name');?></p>
                                <input type="text" name="list_name" value=""/>
                                
                                
                                <input type="submit" name="submit"  value="Save" class="send">
                                    
                                 <?php echo form_close();?>
                                   
                                </div>
                            </div>
                            
                        </div>
                        
                       
                        
                      
                    </body>
                </html>