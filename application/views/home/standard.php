<div class="col-sm-3 col-md-2 sidebar">
    <aside>
        <div class="list-group">
            <a href="#" class="list-group-item disabled">Stores</a>
            <a href="#" class="list-group-item current-active">Sub Menu Name<i class="fa fa-chevron-right"></i></a>
            <a href="#" class="list-group-item">Sub Menu Name2<i class="fa fa-chevron-right"></i></a>
            <a href="#" class="list-group-item">Sub Menu Name3<i class="fa fa-chevron-right"></i></a>
            <a href="#" class="list-group-item">Sub Menu Name4<i class="fa fa-chevron-right"></i></a>
        </div>          
    </aside>
</div>
    <!-- left right -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2" style="padding:0px;padding-top: 80px; ">
    <div class="text-right pull-right" style="padding-right: 10px;"> 
        <i class="fa fa-user"></i>  <a href="<?php echo base_url('home/logout')?>">注销</a>
    </div>
    <ul class='breadcrumb' id='breadcrumb'>
        Current_pos
    </ul>
    <div style="padding: 0px 10px">                       
        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="<?php echo base_url('Uploadfile/post');?>" role="form">
      <div class="form-group">
        <label class="col-sm-2 control-label">安装包</label>
        <div class="col-sm-10">
          <input type="file" id="uploadFile" name="uploadFile">
            <p class="help-block">上传文件选择</p>
        </div>
      </div>
     <div class="form-group">
        <label class="col-sm-2 control-label">版本</label>
        <div class="col-sm-4">
          <input type="text" id="version" class="form-control" name="version">
            <p class="help-block">文件编号</p>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" id="dosubmit" value="upload" class="btn btn-primary btn-lg">上传</button>        </div>
      </div>
    </form>
    </div>
</div>