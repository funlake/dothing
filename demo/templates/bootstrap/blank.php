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



      <!-- Le fav and touch icons -->
      <link rel="shortcut icon" href="<?php echo DO_THEME_BASE;?>/docs/assets/ico/favicon.ico">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo DO_THEME_BASE;?>/docs/assets/ico/apple-touch-icon-144-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo DO_THEME_BASE;?>/docs/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo DO_THEME_BASE;?>/docs/assets/ico/apple-touch-icon-72-precomposed.png">
      <link rel="apple-touch-icon-precomposed" href="<?php echo DO_THEME_BASE;?>/docs/assets/ico/apple-touch-icon-57-precomposed.png"> 
        <link href="<?php echo DO_THEME_BASE;?>/docs/assets/css/main.css" rel="stylesheet">
      <script data-main="<?php echo DO_THEME_BASE;?>/js/main.js" src="<?php echo Uri::GetBase();?>/assets/js/require.js"></script>
        <script type="text/javascript">
      var DOJsBase = '<?php echo Uri::GetBase();?>/assets/js';
      var DOJsModule = '<?php echo Router::GetModule();?>';
      var DOJsMod = '<?php echo Router::GetController();?>_<?php echo Router::GetAction();?>';
    </script>
    </head>

    <body>
      <div class="container">
      <div class="container-fluid">
        <?php echo T("block","message");?>
        <div class="row-fluid">
          <?php echo T("block","breadcrumb");?>
            <?php echo T("module","__CURRENT__");?>
        </div><!--/row-->
        
        <footer>
          <?php echo T("block","footer");?>
        </footer>
        <?php echo T("block","bottom");?>
      </div><!--/.fluid-container-->
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script type="text/javascript">
    
    require([DOJsBase+'/'+DOJsModule+'.js'],function(m){
      m.run(DOJsMod);
    })
    </script>
  </body>
  </html>