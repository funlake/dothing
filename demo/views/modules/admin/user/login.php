<div class="well">    

 <form id="signup" class="form-horizontal" method="post" action="<?php echo Url(DO_ADMIN_INTERFACE.'/user/login','');?>">
  <legend><?php echo L('Sign in');?></legend>		
  <div class="control-group">
   <label class="control-label"><?php echo L('Admin');?></label>
   <div class="controls">
    <div class="input-prepend">
     <span class="add-on"><i class="icon-user"></i></span>
     <input type="text" id="user_name" class="input-xlarge" name="user_name" placeholder="<?php echo L('User name');?>">
   </div>
 </div>
</div>
<div class="control-group">
 <label class="control-label"><?php echo L('Password');?></label>
 <div class="controls">
  <div class="input-prepend">
   <span class="add-on"><i class="icon-lock"></i></span>
   <input type="password" id="user_pass" class="input-xlarge" name="user_pass" placeholder="<?php echo L('Password');?>">
 </div>
</div>
</div>

<div class="control-group">
 <label class="control-label"></label>
 <div class="controls">
  <button type="submit" class="btn btn-success" ><?php echo L('Login');?></button>

</div>

</div>

</form>

</div>
</div>