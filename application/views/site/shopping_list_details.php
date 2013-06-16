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
<script src="<?php echo base_url();?>public/js/jquery.fcbkcomplete.min.js" type="text/javascript"></script>
    
<script type="text/javascript">
    
    $(document).ready(function(){ 
    
    $('.delete_item').click(function(){
var page = $(this);
var itm_id = $(this).attr('rel');
deletechecked('Delete item ?',itm_id,page);


return false;
});
function deletechecked(message,itm_id,page)
{
    var answer = confirm(message)
    if (answer){
     var d_s =
         {
         'id':itm_id
         }  
         $.post("<?php echo base_url().'ajax/delete_item';?>", d_s, function(theResponse){
//				$("#response").html(theResponse);
//				$("#response").slideDown('slow');
                                //slideout();
                                hide_li(page);
			});
    }
    else
        {
            
       return false;
        }
}
function hide_li(li)
{
    li.parents('li').hide();
}
$(".status").click(function(){
    var status;
        if($(this).hasClass('item_active'))
        {
            $(this).addClass('item_innactive').removeClass('item_active');
            status = '0';
            
        }
        else
        {
            $(this).addClass('item_active').removeClass('item_innactive');
            status = '1';
           
        }
    
    
    var item_id = $(this).attr('rel');
    var self =$(this).parent();
    self.removeClass('item_active').addClass('item_innactive');
        var d_s =
         {
         'item_id':item_id,
         'status':status         
         }  
         $.post("<?php echo base_url().'ajax/statusitems';?>", d_s, function(theResponse){
				
                               
                                
                                
                                
			});
       
      
});
    
    });
    </script>
                
</head>
           
                  	
	           
           
    
                    <body>
                 
   
                        
                             
                        <div class="header">
                            <div class="menu">
                                <ul>
                                    
                                    <li><?php echo anchor(base_url(),'Home')?></li>
                                    <li><?php echo anchor(base_url('shopping_list/add'),'+ Add list')?></li>
                                    <li><?php echo anchor(base_url('logout'),'Logout')?></li>
                                </ul>
                                
                            </div>
                            
                        </div>
                        
                        <div id="main_container">
                            <div class="content_p">
                                
                                
                                <div class="cont">
                                    <div class="head_title">
                                        <h1>Details shopping list</h1> 
                                </div>
                                    
                                    <div id="shop_list">
                                    <h1 class="list_name"><?php echo @$shopping_list[0]['list_name'];?></h1>
                                <?php $sh_id = @$shopping_list[0]['id'];?>
                                    <ul class="items">
                                    <?php 
                                    //print_r($shopping_list);
                                    if(is_array($shopping_list))
                                    {
                                    foreach ($shopping_list as $items)
                                    {?>
                                        <li><?php echo $items['item_name'];?> <div class="actions"><div class="status <?php  echo $items['status']== 'bought'? 'item_active':'item_innactive'?>" rel="<?php echo $items['itm_id'];?>"  title="pending/bought"></div> <a href="<?php echo base_url().'items/edit/'.$items['itm_id'].'/'.$sh_id;?>" ><img src="<?php echo base_url()?>public/images/edit.png" /> </a> <a href="javascript:;" class="delete_item" rel="<?php echo $items['itm_id'];?>"><img src="<?php echo base_url()?>public/images/delete.png" /> </a></div></li>
                                    <?php }
                                    }
                                    ?>
                                
                                    </ul>
                                    </div>
                                <?php
                                
                                 $attributes= array('id'=>'settings_form' );
                                    
                                 echo form_open(base_url().'shopping_list/add_item/'.$this->uri->segment(3), $attributes);
                                       ?>
                                    
                                   
                                    
                                <h1 class="big_name">Add new item </h1>   
                                
                                <h1>Item name</h1><p class="error"><?php echo form_error('item_name');?></p>
                                <input type="text" name="item_name" value=""/>
                                <h1>Item description</h1><p class="error"><?php echo form_error('item_description');?></p>
                                <textarea name="item_description" value="">
                                

                                </textarea>
                                
                                <input type="hidden" name="list_id" value="<?php echo $this->uri->segment(3);?>"/>
                                <input type="submit" name="submit"  value="Save" class="send">
                                    
                                 <?php echo form_close();?>
                                    <div id="share">  
                                    
                                    <h1>Share this list</h1>
        <div id="text">
        </div>
        <?php echo form_open(base_url().'shopping_list/share_list/'.$this->uri->segment(3));?>
            <select id="select3" name="select3">
                <?php 
                if(!empty($shared_with))
                    foreach ($shared_with as $sh)
                    {
                ?>
                <option value="<?php echo $sh['id']?>" class="selected"><?php echo $sh['user_name']?></option>
                <?php } ?>
            </select>
            <br/>
            <br/>
            <input type="hidden" name="list_id" value="<?php echo $this->uri->segment(3);?>"/>
            <input type="submit" value="Save" class="send">
        <?php echo form_close();?>
        <script type="text/javascript">
            $(document).ready(function(){                
                $("#select3").fcbkcomplete({
                    json_url: "<?php echo base_url().'ajax/users'?>",
                    addontab: true,                   
                    maxitems: 10,
                    input_min_size: 0,
                    height: 10,
                    cache: true,
                    newel: false
                });
            });
        </script>
                                    </div>        
                                    
                                </div>
                            </div>
                            
                        </div>
                        
                       
                        
                      
                    </body>
                </html>