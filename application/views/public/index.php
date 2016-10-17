<?php if (!isset($hidden_menu)): ?>
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
                            <a href="<?php base_url("home/index") ?>"> <i class="fa fa-home"></i><span>首页</span></a>
                        </li>
                        <li>
                            <a href="<?php base_url("home/index") ?>"> <i class="fa fa-list-ol"></i><span>Warehouse</span></a>
                        </li>
                        <li>
                            <a href="<?php base_url("home/index") ?>"> <i class="fa fa-street-view"></i><span>Menu</span></a>
                        </li>
                        <li>
                            <a href="<?php base_url("home/index") ?>"> <i class="fa fa-book"></i><span>Menu</span></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                     <aside>
                        
                            <div class="list-group">
                                <a href="#" class="list-group-item disabled">Top Menu Name</a>
                                <a href="#" class="list-group-item current-active">Sub Menu Name<i class="fa fa-chevron-right"></i></a>
                                <a href="#" class="list-group-item">Sub Menu Name2<i class="fa fa-chevron-right"></i></a>
                                <a href="#" class="list-group-item">Sub Menu Name3<i class="fa fa-chevron-right"></i></a>
                                <a href="#" class="list-group-item">Sub Menu Name4<i class="fa fa-chevron-right"></i></a>
                            </div>
                        
                    </aside>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2" style="padding:0px;padding-top: 80px; ">
                    <div class="text-right pull-right" style="padding-right: 10px;"> 
                        <i class="fa fa-user"></i> Admin [ Admin ], <a href="<?php echo base_url('home/logout')?>">注销</a></div>

                    <ul class='breadcrumb' id='breadcrumb'>
                         Current_pos
                    </ul>

                    <div style="padding: 0px 10px">                       
                        <?php echo $sub_page ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <style type="text/css">
        body {
            overflow: hidden;
        }
    </style>
    <?php echo $sub_page ?>
<?php endif; ?>