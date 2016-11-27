<view ng-controller = "ProductCtrl">

    <!-- left right -->
<div class="col-sm-12" style="padding:0px;padding-top: 80px; ">
    <div class="text-right pull-right" style="padding-right: 10px;"> 
        <i class="fa fa-user"></i> <?php echo $user["name"] ?> [ Admin ], <a href="<?php echo base_url('home/logout')?>">注销</a>
    </div>
    <ul class='breadcrumb' id='breadcrumb'>
        products
    </ul>
    <div style="padding: 0px 10px"> 
        <div class="panel panel-default grid">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-th-list"></i> 成员列表
        <div class="panel-tools">

            <div class="btn-group">
                <a href="http://localhost:8000/aci/adminpanel/user/add" class="btn  btn-sm "><span class="glyphicon glyphicon-plus"></span> 添加</a>            </div>
            <div class="badge">2</div>
        </div>
    </div>
    <div class="panel-filter ">
        <form class="form-inline" role="form" method="get">
            <div class="form-group">
                <label for="keyword" class="form-control-static control-label">关键词</label>
                <input class="form-control" type="text" name="keyword" value="" id="keyword" placeholder="请输入关键词"></div>
            <button type="submit" name="dosubmit" value="搜索" class="btn btn-success"><i class="glyphicon glyphicon-search"></i></button>
        </form>
    </div>
    <form method="post" id="form_list">
        <div class="panel-body ">
            <table class="table table-hover dataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th>用户名</th>
                        <th>全名</th>
                        <th>邮箱</th>
                        <th>手机号</th>
                        <th>会员组</th>
                        <th>上次登录时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                                            <tr>
                            <td><input type="checkbox" name="pid[]" value="1"></td>
                            <td> <span class="glyphicon glyphicon-user"></span></td>
                            <td>test</td>
                            <td>胡子锅</td>
                            <td>hubinjie@live.cn</td>
                            <td>13099999999</td>
                            <td>超级管理员</td>
                            <td>2016-11-25 01:31:40</td>
                            <td>
                                <a href="http://localhost:8000/aci/adminpanel/user/edit/1" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> 修改</a>                            </td>
                        </tr>
                                            <tr>
                            <td><input type="checkbox" name="pid[]" value="2"></td>
                            <td> <span class="glyphicon glyphicon-lock"></span></td>
                            <td>xiaoer</td>
                            <td>小二</td>
                            <td>lyhuc@163.com</td>
                            <td>13099999999</td>
                            <td>普通管理员</td>
                            <td></td>
                            <td>
                                <a href="http://localhost:8000/aci/adminpanel/user/edit/2" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> 修改</a>                            </td>
                        </tr>
                    
                    </tbody>
                </table>

        </div>
        <div class="panel-footer">
           <div class="pull-left">
             <div class="btn-group">
                <button type="button" class="btn btn-default" id="reverseBtn"><span class="glyphicon glyphicon-ok"></span> 反选</button>
                <button class="btn btn-default" id="lockBtn"><span class="glyphicon glyphicon-lock"></span> 反设置禁止登录</button>                        
                <button class="btn btn-default" id="deleteBtn"><span class="glyphicon glyphicon-remove"></span> 删除勾选</button>                    
            </div>
            </div>
            <div class="pull-right">
            </div>
            <div>
                <table>
                    <tr>
                        <td></td>
                        <td><input type='text' ng-model="new_item.name" placeholder="名称"></td>
                        <td><input type='text' ng-model="new_item.specification" placeholder="规格"></td>
                        <td><input type='phone' ng-model="new_item.unit" placeholder="单位"></td>
                        <td><input type='text' ng-model="new_item.length" placeholder="长度"></td>
                        <td><input type='text' ng-model="new_item.width" placeholder="宽度"></td>
                        <td><input type='text' ng-model="new_item.height" placeholder="高度"></td>
                        <td><input type='text' ng-model="new_item.brand" placeholder="品牌"></td>
                        <td><input type='text' ng-model="new_item.barcode" placeholder="条码"></td>
                        
                        <td>
                                           
                            <a href="javascript:void(0);" ng-click="new_product($event)" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-plus"></span> 新建
                            </a>
                        </td>
                        </tr>
                </table>
            </div>
        </div>

    </form>
</div>
        <h3 class="page-header">
            <a href="<?php echo base_url('product/editor?id=0') ?>" class="btn btn-info btn-sm pull-right">
                <span class="glyphicon glyphicon-plus"></span> 新建产品</a>
                商品
        </h3>
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>友情提示</strong> Please believe in God.
        </div> 
        <div class="panel panel-default grid">
            <div class="panel-body">
                <table class="table table-hover dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>名称</th>
                            <th>规格</th>
                            <th style="width:50px">单位</th>
                            <th style="width:50px">长度</th>
                            <th style="width:50px">宽度</th> 
                            <th style="width:50px">高度</th>
                            <th>品牌</th>
                            <th>条码</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in products">
                        <td>{{item.Id}}</td>
                        <td>{{item.Name}}</td>
                        <td>{{item.Specification}}</td>
                        <td>{{item.Unit}}</td>
                        <td>{{item.Length}}</td>
                        <td>{{item.Width}}</td>
                        <td>{{item.Height}}</td>
                        <td>{{item.Brand}}</td>
                        <td>{{item.Barcode}}</td>
                        <td>
                             <a href="<?php echo base_url('product/editor') ?>?id={{item.Id}}" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-edit"></span> 编辑
                            </a>               
                            <a href="javascript:void(0);" ng-click="remove_product($event,item,$index);" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-remove"></span> 删除
                            </a>
                        </td>
                        </tr>
                        
                    </tbody>
                </table>
    	    </div>

        </div>                   
        
    </div>
</div>
</view>

<script>


angular.module("Warehouse-app").controller("ProductCtrl",function($scope,httpService){
	$scope.products = [];
    $scope.current_product = {};
    $scope.items = [];
    $scope.new_item = {};
    var url = "<?php echo base_url('product/items')?>";
    httpService(url,{},function(json){
        if (json.status){
            $scope.products = json.result;
        }
    });
    $scope.select_product =function(item){
        $scope.current_product = item;
        $scope.load_inventory();
    }
   
    $scope.new_product = function(event){
        
        if ($scope.new_item.name!=''){
            var url = base_url + "/product/add";
            httpService(url,$scope.new_item,function(json){
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
