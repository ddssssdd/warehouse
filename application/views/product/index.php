<view ng-controller = "ProductCtrl">

    <!-- left right -->
<div class="col-sm-12" style="padding:0px;padding-top: 80px; ">
    <div class="text-right pull-right" style="padding-right: 10px;"> 
        <i class="fa fa-user"></i> <?php echo $user["name"] ?> [ Admin ], <a href="<?php echo base_url('home/logout')?>">注销</a>
    </div>
    <ul class='breadcrumb' id='breadcrumb'>
        产品管理
    </ul>
    <div style="padding: 0px 10px"> 
      
        <h3 class="page-header">
            <a href="<?php echo base_url('product/editor?id=0') ?>" target="_blank" class="btn btn-info btn-sm pull-right">
                <span class="glyphicon glyphicon-plus"></span> 新建产品</a>
                产品管理
        </h3>
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>友情提示</strong> Please believe in God.
        </div> 
        <div class="panel panel-default grid">
             <div class="panel-heading">
                <i class="glyphicon glyphicon-th-list"></i> 产品列表
                <div class="panel-tools">

                    <div class="btn-group">
                        <a href="javascript:void(0)" ng-click="reload($event);" class="btn  btn-sm "><span class="glyphicon glyphicon-refresh"></span> 刷新</a>

                        <a href="<?php echo base_url('product/editor?id=0') ?>" target="_blank" class="btn  btn-sm "><span class="glyphicon glyphicon-plus"></span> 添加</a>            
                    </div>
                    <div class="badge">2</div>
                </div>
            </div>
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
                             <a href="<?php echo base_url('product/editor') ?>?id={{item.Id}}"  target="_blank" class="btn btn-default btn-xs">
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
    $scope.reload = function(event){
        var url = "<?php echo base_url('product/items')?>";
        httpService(url,{},function(json){
            if (json.status){
                $scope.products = json.result;
            }
        });    
    }
    
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
    $scope.reload();

});
</script>
