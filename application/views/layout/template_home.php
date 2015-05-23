<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Aplikasi Simple Stock</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo config_item('assets');?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo config_item('assets');?>css/navbar.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo config_item('assets');?>css/jquery-ui.css" />
    <!-- The link to the CSS that the grid needs -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>ektension/css/ui.jqgrid.css" />

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo config_item('assets');?>js/ie-emulation-modes-warning.js"></script>

    <script src="<?php echo config_item('assets');?>js/jquery-1.11.3.min.js"></script>

     <!-- We support more than 40 localizations -->
    <script type="text/ecmascript" src="<?php echo base_url();?>ektension/js/i18n/grid.locale-en.js"></script>
    <!-- This is the Javascript file of jqGrid -->   
    <script type="text/ecmascript" src="<?php echo base_url();?>ektension/js/jquery.jqGrid.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <input type="hidden" id="base_url" class="form-control" value='<?php echo base_url(); ?>'>
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Simple Stok</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="<?php echo base_url(); ?>home">Home</a></li>
              

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Master <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo base_url(); ?>masterbarang">Master Barang</a></li>
                  <li><a href="<?php echo base_url(); ?>mastercabang">Master Cabang</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Transaksi <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Barang Masuk</a></li>
                  <li><a href="#">Barang Keluar</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">History <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Laporan</a></li>
                </ul>
              </li>

              <li><a href="<?php echo base_url() ?>home/keluar">Keluar</a></li>

            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

        <?php
          if(isset($content)){
             echo $content;
          } 
        ?>
    

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="<?php echo config_item('assets');?>js/bootstrap.min.js"></script>
   
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo config_item('assets');?>js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
