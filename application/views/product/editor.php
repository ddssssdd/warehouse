<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2" style="padding:0px;padding-top: 80px; "
	 ng-controller="ProductEditCtrl">
    <div class="text-right pull-right" style="padding-right: 10px;"> 
    	<i class="fa fa-user"></i> <?php echo $user["name"] ?> [ 超级管理员], <a href="<?php echo base_url('home/logout')?>">注销</a>
    </div>
	<ul class="breadcrumb" id="breadcrumb">
    	<li><a href="">系统管理</a></li>
    	<li><a href="">管理产品</a></li>
        
        <li> 编辑 </li>                    
    </ul>
    <div style="padding: 0px 10px">
    	<form class="form-horizontal bv-form" role="form" id="validateform" name="validateform"  novalidate="novalidate">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="icon-edit icon-large"></i>修改产品资料
					<div class="panel-tools">
						<div class="btn-group">
							<a href="<?php base_url('product/index')?>" class="btn  btn-sm "><span class="glyphicon glyphicon-arrow-left"></span> 返回</a>			
						</div>
					</div>
				</div>
			<div class="panel-body">
				<fieldset>
					<legend>基本信息</legend>
					<div class="form-group">
						<label class="col-sm-2 control-label">名称</label>
						<div class="col-sm-4">			
							<input type="text" class="form-control" ng-model="product.Name" placeholder="" value="" size="45">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">规格</label>
						<div class="col-sm-4">
						  <input  type="text" class="form-control" ng-model="product.Specification" placeholder="产品规格" value="" size="45">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">单位</label>
						<div class="col-sm-4">
						  <input  type="text" class="form-control" ng-model="product.Unit" placeholder="单位" value="" size="45">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">单价</label>
						<div class="col-sm-4">
						  <input  type="text" class="form-control" ng-model="product.Price" placeholder="单价" value="" size="45">
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="col-sm-2 control-label">长度</label>
						<div class="col-sm-4">
						  <input  type="text" class="form-control"  ng-model="product.Length" placeholder="长度" size="45" >
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="col-sm-2 control-label">宽度</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" ng-model="product.Width" placeholder="宽度" size="45" data-bv-field="mobile">
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="col-sm-2 control-label">高度</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" ng-model="product.Height" placeholder="高度" size="45" data-bv-field="mobile">
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="col-sm-2 control-label">品牌</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" ng-model="product.Brand" placeholder="品牌" size="45" data-bv-field="mobile">
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="col-sm-2 control-label">条形码</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" ng-model="product.Barcode" placeholder="条形码" size="45" data-bv-field="mobile">
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="col-sm-2 control-label">用户组</label>
						<div class="col-sm-4">
						  <select class="form-control validate[required]" name="group_id" data-bv-field="group_id">
							  <option value="">==请选择==</option><option value="1" selected="selected">超级管理员</option><option value="2">普通管理员</option>							</select><i class="form-control-feedback" data-bv-icon-for="group_id" style="display: none;"></i>
						<small class="help-block" data-bv-validator="notEmpty" data-bv-for="group_id" data-bv-result="NOT_VALIDATED" style="display: none;">请选择用户组</small></div>
					</div>
				</fieldset>

				<div class="panel pandel-default">
					<div class="panel-body">
						<table class="table table-hover dataTable">
							<thead>
								<th>仓库</th>
								<th>库存</th>
								<th>最小单价</th>
								<th>最大单价</th>
								<th>最后更新</th>								
							</thead>
							<tbody>
							<tr ng-repeat="item in product.Inventories">
								<td>
									{{item.Name}}
								</td>
								<td>
									{{item.Quantity}}
								</td>
								<td>
									{{item.MinPrice}}
								</td>
								<td>
									{{item.MaxPrice}}
								</td>
								<td>
									{{item.LastUpdate}}
								</td>
							</tr>
							<tbody>
						</table>
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" id="dosubmit" class="btn btn-primary " ng-click="new_product($evnet)">保存</button>
					
     			</div>
			</div>
		</form>
 	</div>
 </div>
 

 <script>

angular.module("Warehouse-app").controller("ProductEditCtrl",function($scope,httpService){
	$scope.product = {};
    $scope.current_product = {};
    
	var id = <?php echo $id?>;
	$scope.product = {Id:0};
	var url = "<?php echo base_url('product/find')?>";
	httpService(url,{id:id},function(json){
    	if (json.status){
        	$scope.product = json.result;
        	$scope.product.Price =$scope.product.Price *1.00;
        }
	});
       
   
    $scope.new_product = function(event){
        
        if ($scope.product.name!=''){
            var url = base_url + "/product/"+($scope.product.Id>0?"edit":"add");
            httpService(url,$scope.product,function(json){
                console.log(json);
                if (json.status){
                    $scope.products = json.result;
                }
            });
        }
    }
    $scope.remove_product = function(event,product,index){
        var url = base_url + "/product/remove";
        httpService(url,{id:product.Id},function(json){
            if (json.status){
                $scope.products.splice(index,1);
            }
        });
    }
   

});
</script>