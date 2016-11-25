<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2" style="padding:0px;padding-top: 80px; ">
    <div class="text-right pull-right" style="padding-right: 10px;"> 
    	<i class="fa fa-user"></i> <?php echo $user["name"] ?> [ 超级管理员], <a href="<?php echo base_url('home/logout')?>">注销</a>
    </div>
	<ul class="breadcrumb" id="breadcrumb">
    	<li><a href="http://localhost:8000/aci/adminpanel/user/index">用户管理</a></li>
    	<li><a href="http://localhost:8000/aci/adminpanel/user/add">管理用户</a></li>
        <li><a href="http://localhost:8000/aci/adminpanel/user/index">用户列表</a></li>
        <li> 编辑 </li>                    
    </ul>
    <div style="padding: 0px 10px">
    	<form class="form-horizontal bv-form" role="form" id="validateform" name="validateform"  novalidate="novalidate">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="icon-edit icon-large"></i>修改用户资料
					<div class="panel-tools">
						<div class="btn-group">
							<a href="http://localhost:8000/aci/adminpanel/user/index" class="btn  btn-sm "><span class="glyphicon glyphicon-arrow-left"></span> 返回</a>			
						</div>
					</div>
				</div>
			<div class="panel-body">
				<fieldset>
					<legend>基本信息</legend>
					<div class="form-group">
						<label class="col-sm-2 control-label">用户名</label>
						<div class="col-sm-4"> test						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">密码</label>
						<div class="col-sm-4">
						  <input name="password" type="password" class="form-control" id="password" placeholder="保留为空，密码不修改" value="" size="45">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">重复密码</label>
						<div class="col-sm-4">
						  <input name="repassword" type="password" class="form-control validate[equals[password]]" id="repassword" placeholder="保留为空，密码不修改" value="" size="45">
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-4">
						  <input name="email" type="text" class="form-control  validate[required,custom[email]]" value="hubinjie@live.cn" id="email" placeholder="请输入Email" size="45" data-bv-field="email"><i class="form-control-feedback" data-bv-icon-for="email" style="display: none;"></i>
						<small class="help-block" data-bv-validator="notEmpty" data-bv-for="email" data-bv-result="NOT_VALIDATED" style="display: none;">请输入Email</small></div>
					</div>
					<div class="form-group has-feedback">
						<label class="col-sm-2 control-label">手机号</label>
						<div class="col-sm-4">
							<input name="mobile" type="text" class="form-control  validate[required,custom[mobile]]" value="13099999999" id="mobile" placeholder="请输入手机号" size="45" data-bv-field="mobile"><i class="form-control-feedback" data-bv-icon-for="mobile" style="display: none;"></i>
						<small class="help-block" data-bv-validator="notEmpty" data-bv-for="mobile" data-bv-result="NOT_VALIDATED" style="display: none;">请输入手机号</small><small class="help-block" data-bv-validator="regexp" data-bv-for="mobile" data-bv-result="NOT_VALIDATED" style="display: none;">手机号只能全为数字</small></div>
					</div>
					<div class="form-group has-feedback">
						<label class="col-sm-2 control-label">用户组</label>
						<div class="col-sm-4">
						  <select class="form-control validate[required]" name="group_id" data-bv-field="group_id">
							  <option value="">==请选择==</option><option value="1" selected="selected">超级管理员</option><option value="2">普通管理员</option>							</select><i class="form-control-feedback" data-bv-icon-for="group_id" style="display: none;"></i>
						<small class="help-block" data-bv-validator="notEmpty" data-bv-for="group_id" data-bv-result="NOT_VALIDATED" style="display: none;">请选择用户组</small></div>
					</div>
				</fieldset>

				<fieldset>
					<legend>可选信息</legend>

      				<div class="form-group">
						<label class="col-sm-2 control-label">全名</label>
						<div class="col-sm-4">
                  			<input name="fullname" type="text" class="form-control" id="fullname" placeholder="请输入详细内容" value="胡子锅" size="45">
						</div>
					</div>
  	  				<div class="form-group">
						<label class="col-sm-2 control-label">成员图像</label>
						<div class="col-sm-9">
							<img width="100" id="thumb_SRC" border="1" src="/aci/uploadfile/user//aci.jpg"><input type="hidden" id="thumb" name="thumb" value="aci.jpg"> 
                    		<a #="" class="btn btn-default btn-sm uploadThumb_a">选择图片 ...</a><span class="help-block">只支持图片上传.</span>
						</div>
					</div>
            		<div class="form-group">
						<label class="col-sm-2 control-label">是否锁定登录</label>
						<div class="col-sm-4">
                  			<label class="radio-inline">
                      			<input type="radio" name="is_lock" id="is_lock1" value="1"> 是
                    		</label>
                    		<label class="radio-inline">
                      			<input type="radio" name="is_lock" id="is_lock2" value="0" checked="checked"> 否
                    		</label>
						</div>
					</div>
	      		</fieldset>
				<div class="form-actions">
					<button type="submit" id="dosubmit" class="btn btn-primary ">保存</button>		</div>
     			</div>
			</div>
		</form>
 	</div>
 </div>