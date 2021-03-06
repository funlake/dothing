<?php
use \Dothing\Lib\Template;
use \Dothing\Lib\Uri;
use \Dothing\Lib\Router;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bootstrap, from Twitter</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Le styles -->
  <link href="<?php echo DO_THEME_BASE;?>/docs/assets/css/bootstrap.css" rel="stylesheet">
  <style type="text/css">
  body {
    padding-top: 60px;
    padding-bottom: 40px;
  }
  .sidebar-nav {
    padding: 9px 0;
  }
  </style>
  <link href="<?php echo DO_THEME_BASE;?>/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo DO_THEME_BASE;?>/docs/assets/css/bootstrap-glyphicons.css" rel="stylesheet">

  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->

      <!-- Le fav and touch icons -->
      <link rel="shortcut icon" href="<?php echo DO_THEME_BASE;?>/docs/assets/ico/favicon.ico">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo DO_THEME_BASE;?>/docs/assets/ico/apple-touch-icon-144-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo DO_THEME_BASE;?>/docs/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo DO_THEME_BASE;?>/docs/assets/ico/apple-touch-icon-72-precomposed.png">
      <link rel="apple-touch-icon-precomposed" href="<?php echo DO_THEME_BASE;?>/docs/assets/ico/apple-touch-icon-57-precomposed.png"> 
      <link href="<?php echo DO_THEME_BASE;?>/docs/assets/css/main.css" rel="stylesheet">
      <link href="<?php echo DO_THEME_BASE;?>/js/plugin/css/chosen/chosen.css" rel="stylesheet">
      <link href="<?php echo DO_THEME_BASE;?>/js/plugin/css/icheck/_all.css" rel="stylesheet">
      <script data-main="<?php echo DO_THEME_BASE;?>/js/main.js" src="<?php echo Uri::GetBase();?>/assets/js/require.js"></script>
        <script type="text/javascript">
          var DOJsBase = '<?php echo Uri::GetBase();?>/assets/js';
          var DOJsModule = '<?php echo Router::GetModule();?>';
          var DOJsMod = '<?php echo Router::GetController();?>_<?php echo Router::GetAction();?>';
      </script>
    </head>

    <body>
    <div class="ui-loader">Loading...</div>
      <div class="row">
        <div class="navbar navbar-fixed-top col-lg-12 navbar-inverse">
            <div class="container">
              <div class="nav-collapse">
              <?php echo T("block","mainmenu");?>
              </div>
           </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
       <?php echo T("block","message");?>
      </div>
    </div>
      <div class="row">
          <div class="container">
              <div class="col-lg-12">
              <?php echo T("module","__CURRENT__");?>
              </div>
        </div>
      </div><!--/.fluid-container-->
      <div class="row">
        <div class="container">
              <footer>
          <?php echo T("block","footer");?>
        </footer>
        <?php echo T("block","bottom");?>
      </div>
    </div>
      <div class="row">
            <div class="container">
              <?php echo T("block","debug");?>
            </div>
       </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script type="text/javascript">
    
    require([DOJsBase+'/'+DOJsModule+'.js'],function(m){
      m.run(DOJsMod);
      $(".ui-loader").animate({
        opacity:0,zIndex:0
      },500)
    })
    </script>
  </body>
  </html>
