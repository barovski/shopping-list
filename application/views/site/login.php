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
               
              
                
                
                
</head>
            
                    <body>
                        <div id="header_login">
                        <div id="logo"></div>
                    </div>
                        <div id="login">
                            
                            <div id="login_box">
                                <div id="title"><h1><a class="active" href="<?php echo base_url().'login'?>">Login</a> <strong> or </strong> <a href="<?php echo base_url().'register'?>">Register</a></h1></div>
                                <div class="cont">
                                    <p class="error_name_pass"><?php if(isset($error_login))
                                    { echo $error_login;
                                    }   ?></p>
                                    <?php 
                                    $params=array('id'=>'login_form');
                                        
                                   
                                    echo form_open(base_url().'login',$params);?>
                                    <h4>User name </h4>
                                    <p class="error"><?php echo form_error('name');?></p>
					<p class="text">
						<input  type="text" name="name" value="<?php echo set_value('name');?>">
					</p>
                                    <h4>Password </h4>
                                    <p class="error"><?php echo form_error('password');?></p>
					
						<input type="password" name="password" <?php echo set_value('password');?>>
					
					
                                                    <input type="submit" name="submit"  value="Login" class="send">
					
                                    <?php echo form_close();?>
                                    
                                    
                                </div>
                            </div>
                            
                        </div>
                    
                    
                    </body>
                </html>