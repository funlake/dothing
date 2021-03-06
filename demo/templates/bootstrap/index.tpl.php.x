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
      <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/jquery.js"></script>    
        <link href="<?php echo DO_THEME_BASE;?>/docs/assets/css/main.css" rel="stylesheet">
    </head>

    <body>
      <div class="container">
        <div class="navbar navbar-fixed-top navbar-inverse">
          <div class="navbar-inner">
            <div class="container-fluid">
              <div class="nav-collapse collapse">
<!--               <p class="navbar-text pull-right">
                Logged in as <a href="#" class="navbar-link">Username</a>
              </p> -->
              <block:mainmenu/>
            </div><!--/.nav-collapse -->
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <block:message/>
        <div class="row-fluid">
                    <div class="span3">
            <block:sidebar/>
          </div><!--/span3-->
          <div class="span9">

            <module:__CURRENT__/>
          </div><!--/span9-->

        </div><!--/row-->
        
        <footer>
          <block:footer/>
        </footer>
        <block:bottom/>
      </div><!--/.fluid-container-->
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/bootstrap-transition.js"></script>
    <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/bootstrap-alert.js"></script>
    <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/bootstrap-modal.js"></script>
    <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/bootstrap-tab.js"></script>
    <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/bootstrap-popover.js"></script>
    <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/bootstrap-button.js"></script>
    <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/bootstrap-collapse.js"></script>
    <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/bootstrap-carousel.js"></script>
    <script src="<?php echo DO_THEME_BASE;?>/docs/assets/js/bootstrap-typeahead.js"></script>
  </body>
  </html>
