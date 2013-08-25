<div class="row">    
  <div class="col-lg-3"></div>
 <div class="col-lg-6">
 <form id="signup" class="form-horizontal" method="post" action="http://localhost/dothing/demo/index.php/ads007/user/login">
  <fieldset>
    <legend><pre/>Array
(
    [0] => Array
        (
            [function] => AutoLoadLib
            [class] => DOLoader
            [type] => ::
            [args] => Array
                (
                    [0] => DOLang
                )

        )

    [1] => Array
        (
            [file] => D:\develope\htdocs\dothing\include\function.php
            [line] => 143
            [function] => spl_autoload_call
            [args] => Array
                (
                    [0] => DOLang
                )

        )

    [2] => Array
        (
            [file] => D:\develope\htdocs\dothing\demo\modules\admin\view\user\login.php
            [line] => 6
            [function] => L
            [args] => Array
                (
                    [0] => Sign in
                )

        )

    [3] => Array
        (
            [file] => D:\develope\htdocs\dothing\lib\Template.php
            [line] => 129
            [args] => Array
                (
                    [0] => D:\develope\htdocs\dothing\demo\modules\admin\view\user\login.php
                )

            [function] => include
        )

    [4] => Array
        (
            [file] => D:\develope\htdocs\dothing\lib\View.php
            [line] => 41
            [function] => ParseHtml
            [class] => DOTemplate
            [type] => ::
            [args] => Array
                (
                    [0] => D:\develope\htdocs\dothing\demo\modules\admin\view\user\login.php
                    [1] => 
                )

        )

    [5] => Array
        (
            [file] => D:\develope\htdocs\dothing\lib\Controller.php
            [line] => 242
            [function] => Display
            [class] => DOView
            [object] => DOView Object
                (
                    [controller] => DOControllerUser Object
                        (
                        )

                )

            [type] => ->
            [args] => Array
                (
                    [0] => D:\develope\htdocs\dothing\demo\modules\admin\view\user\login.php
                    [1] => 
                )

        )

    [6] => Array
        (
            [file] => D:\develope\htdocs\dothing\demo\modules\admin\user.php
            [line] => 51
            [function] => Display
            [class] => DOController
            [object] => DOControllerUser Object
                (
                )

            [type] => ->
            [args] => Array
                (
                    [0] => 
                )

        )

    [7] => Array
        (
            [function] => loginAction
            [class] => DOControllerUser
            [object] => DOControllerUser Object
                (
                )

            [type] => ->
            [args] => Array
                (
                    [0] => stdClass Object
                        (
                            [get] => Array
                                (
                                )

                            [post] => Array
                                (
                                )

                            [cookie] => Array
                                (
                                    [828e0013b8f3bc1bb22b4f57172b019d] => viq6t3f2c9ipqpdnkpiq9rmgu7
                                )

                            [session] => Array
                                (
                                    [ads007/user/login_p] => 1
                                )

                        )

                )

        )

    [8] => Array
        (
            [file] => D:\develope\htdocs\dothing\lib\Router.php
            [line] => 54
            [function] => call_user_func
            [args] => Array
                (
                    [0] => Array
                        (
                            [0] => DOControllerUser Object
                                (
                                )

                            [1] => loginAction
                        )

                    [1] => stdClass Object
                        (
                            [get] => Array
                                (
                                )

                            [post] => Array
                                (
                                )

                            [cookie] => Array
                                (
                                    [828e0013b8f3bc1bb22b4f57172b019d] => viq6t3f2c9ipqpdnkpiq9rmgu7
                                )

                            [session] => Array
                                (
                                    [ads007/user/login_p] => 1
                                )

                        )

                )

        )

    [9] => Array
        (
            [file] => D:\develope\htdocs\dothing\demo\index.php
            [line] => 20
            [function] => Dispatch
            [class] => DORouter
            [type] => ::
            [args] => Array
                (
                    [0] => Array
                        (
                            [0] => ads007
                            [1] => user
                            [2] => login
                            [3] => Array
                                (
                                )

                        )

                )

        )

)
Sign in</legend>		
    <div class="form-group">
     <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input type="text" id="user_name" class="form-control" name="user_name" placeholder="User name" required>
    </div>
  </div>
  <div class="form-group">
   <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input type="password" id="user_pass" class="form-control"  name="user_pass" placeholder="Password" required>
  </div>
</div>
   <div class="row">
    <div class="col-lg-10"></div>
    <div class="form-group col-lg-2">
      <button type="submit" class="btn btn-success" >Login</button>
    </div>
  </div>
</fieldset>
</form>
</div>
  <div class="col-lg-3"></div>
</div>