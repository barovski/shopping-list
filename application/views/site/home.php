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

<script src="<?php echo base_url();?>public/js/jquery-1.7.1.min.js" type="text/javascript"></script>
               
                
                
    <script type="text/javascript">
        
         
            </script>   
            
           
                
</head>
              
    
                    <body>
                       
                        
                        <div class="header">
                            <div class="menu">
                                <ul>
                                    
                                    <li><?php echo anchor(base_url(),'Home','class="active"')?></li>
                                    <li><?php echo anchor(base_url('shopping_list/add'),'+ Add list')?></li>
                                    <li><?php echo anchor(base_url('logout'),'Logout')?></li>
                                        
                                    
                                </ul>
                                
                            </div>
                            
                            
                           
                        </div>
                        <div class="top_content"
                     
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <div id="main_container">
                            <div class="content">
                                <div class="head_title">
                                    
                                </div>
                                
                                
                                <div class="box">
                                    
                                 <?php
                                 
                                 if(!empty($my_list))
                                 {
                                      echo '<ul>';
                                  foreach ($my_list as $list)
                                  {
                                     
                                     
                                      
                                       ?> 
                         <li> <a href="<?php echo base_url().'shopping_list/details/'.$list['id']?>"><?php echo $list['list_name'];?> </a></li>
                                     
                                      
                                      
                               <?php   }
                                echo '</ul>';
                                 
                                 }
                                 else
                                 {
                                     echo 'No Shopping list ';
                                 }
                                 ?>
                                
                                     
                                 </div>
                                
                                
                                <div class="box">
                                    
                                 <?php
                                 
                                 if(!empty($shared_list))
                                 {
                                      echo '<ul>';
                                  foreach ($shared_list as $shared)
                                  {
                                     
                                      
                                      
                                       ?> 
                                         <li> <a href="<?php echo base_url().'shopping_list/view_list/'.$shared['id']?>"><?php echo $shared['list_name'];?> </a></li>
                                     
                                      
                                      
                               <?php   }
                                echo '</ul>';
                                 
                                 }
                                 else
                                 {
                                     echo 'No shared list ';
                                 }
                                 ?>
                                
                                     
                                 </div>
                                
                                
                        </div>
                        </div>
                        
                        
                    </body>
                </html>