<div class="row">    
  <div class="col-lg-3"></div>
 <div class="col-lg-6">
 <form id="signup" class="form-horizontal" method="post" action="<?php echo Url('admin/user/login','');?>">
  <fieldset>
    <legend><?php echo L('Sign in');?></legend>		
    <div class="form-group">
     <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input type="text" id="user_name" class="form-control" name="user_name" placeholder="<?php echo L('User name');?>" required>
    </div>
  </div>
  <div class="form-group">
   <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input type="password" id="user_pass" class="form-control"  name="user_pass" placeholder="<?php echo L('Password');?>" required>
  </div>
</div>
   <div class="row">
    <div class="col-lg-10"></div>
    <div class="form-group col-lg-2">
      <button type="submit" class="btn btn-success" ><?php echo L('Login');?></button>
    </div>
  </div>
</fieldset>
</form>
</div>
  <div class="col-lg-3"></div>
</div>