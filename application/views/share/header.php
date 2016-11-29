
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="robots" content="noindex,nofollow" />
<title><?php echo SITE_NAME?></title>
<link href="<?php echo base_url('css/bootstrap.min.css')?>" rel="stylesheet">
<link type="text/css" href="<?php echo base_url('css/font-awesome.min.css')?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('css/jquery.dataTables.min.css')?>" rel="stylesheet" />
<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo base_url('css/font-awesome-ie7.min.css')?>">
<![endif]-->
<link type="text/css" href="<?php echo base_url('css/jquery-ui-1.10.0.custom.css')?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url('css/style.css')?>">

<script src="<?php echo base_url('/scripts/lib/jquery.js')?>" ></script>
<script src="<?php echo base_url('/scripts/lib/jquery-ui-1.10.0.custom.min.js')?>"></script>
<script src="<?php echo base_url('/scripts/lib/jquery.datetimepicker.js')?>"></script>
<script src="<?php echo base_url('/scripts/lib/jquery.validationEngine-zh_CN.js')?>" ></script>
<script src="<?php echo base_url('/scripts/lib/jquery.validationEngine.js')?>" ></script>
<script src="<?php echo base_url('/scripts/lib/global.js')?>"></script>

<script src="<?php echo base_url('/scripts/lib/angular.min.js')?>"></script>
<script src="<?php echo base_url('/scripts/lib/angular-md5.min.js')?>"></script>
<script src="<?php echo base_url('/scripts/layer/layer.js')?>"></script>
<script src="<?php echo base_url('/scripts/common.js')?>"></script>

 <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="<?php echo base_url(ADMIN_CSS_PATH.'ie8-responsive-file-warning.js')?>"></script><![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        var base_url = "<?php echo base_url() ?>";
    </script>
</head>
<body ng-app="Warehouse-app" >
<script>
	angular.module("Warehouse-app",["commonService"]);
</script>
	
<div id="dialog" style="padding:0px;"></div>
    <style type="text/css">
        .objbody {
            overflow: hidden
        }
    </style>
    <div class="white-bg">
      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">WareHouse</a>
                    <p> </p>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right navbar-icon-menu">
                        <li>
                            <a href="<?php echo base_url("store/index") ?>"> <i class="fa fa-home"></i><span>首页</span></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url("stocks/in") ?>"> <i class="fa fa-list-ol"></i><span>入库</span></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url("stocks/out") ?>"> <i class="fa fa-street-view"></i><span>出库</span></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url("home/index") ?>"> <i class="fa fa-book"></i><span>系统管理</span></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
      </nav>
      <div class="container-fluid">
            <div class="row">
                <!-- content begin -->
                

           