<view ng-controller = "StoreCtrl">
<div class="col-sm-3 col-md-2 sidebar">
    <aside>
        <div class="list-group">
            <a href="#" class="list-group-item disabled">筛选</a>
            
            <a href="javascript:void(0)"
                 class="list-group-item {{current_item.Id==item.Id?'current-active':''}}"
                 ng-repeat="item in menus"
                 ng-click="select_menu(item);">
                 {{item.Name}}<i class="fa fa-chevron-right"></i>
            </a>
  
        </div>          
    </aside>
</div>
    <!-- left right -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2" style="padding:0px;padding-top: 80px; ">
    <div class="text-right pull-right" style="padding-right: 10px;"> 
        <i class="fa fa-user"></i> <?php echo $user["name"] ?> [ Admin ], <a href="<?php echo base_url('home/logout')?>">注销</a>
    </div>
    <ul class='breadcrumb' id='breadcrumb'>
        Stores
    </ul>
    <div style="padding: 0px 10px">                       
        <div class="panel panel-default grid">
             <div class="panel-heading">
                <i class="glyphicon glyphicon-th-list"></i> 操作列表
                <div class="panel-tools">

                    <div class="btn-group">
                        <a href="javascript:void(0)" ng-click="reload($event);" class="btn  btn-sm "><span class="glyphicon glyphicon-refresh"></span> 刷新</a>

                        
                    </div>
                    <div class="badge">{{details.length}}</div>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>产品</th>
                            <th>库房</th>                            
                            <th>价格</th>                            
                            <th>方式</th>
                            <th>之前</th> 
                            <th>数量</th>
                            <th>之后</th>
                            <th>时间</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in details | filter:search_item " style="{{item.Method=='In'?'':'background-color: #1ABC9C;'}}">
                        <td>{{item.UpdateSequ}}</td>
                        <td>{{item.ProductId}}</td>
                        <td>{{item.StoreId}}</td>
                        <td>{{item.Price | currency:"￥"}}</td>                        
                        <td>{{item.Method=='In'?'入库':'出库'}}</td>
                        <td>{{item.BeforeUpdate}}</td>
                        <td>{{item.Method=='In'?'+':'-'}} {{item.Quantity}}</td>
                        <td>{{item.AfterUpdate}}</td>
                        <td>{{item.UpdateDate}}</td>  
                        <td>
                             <a href="<?php echo base_url('store/check_inventory') ?>?id={{item.Id}}&method={{item.Method}}"  target="_blank" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-edit"></span> 查看{{item.Method=='In'?'入库单':'出库单'}}
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
var inventory_id = <?php echo $inventory_id ?>;
var product_id = <?php echo $product_id ?>;
var store_id = <?php echo $store_id ?>;
angular.module("Warehouse-app")
.controller("StoreCtrl",function($scope,httpService){
	$scope.menus = [{Id:1,Name:'全部'},{Id:2,Name:'入库'},{Id:3,Name:'出库'}];
    $scope.current_item = {Id:1,Name:'全部'};
    $scope.store_id = store_id;
    $scope.product_id = product_id;
    $scope.inventory_id = inventory_id;
    $scope.details = [];
    $scope.select_menu =function(item){
        $scope.current_item = item;        
    }
    $scope.init_data = function()
    {
        $scope.details = [];
        var url = "<?php echo base_url('stocks/details')?>";
        httpService(url,{store_id:$scope.store_id,product_id:$scope.product_id,inventory_id:inventory_id},
            function(json){
            if (json.status){
                $scope.details = json.result;
                console.log($scope.products);
            }
        });
    } 
    $scope.search_item = function(item){
        if ($scope.current_item.Id==1){
            return true;
        }else if ($scope.current_item.Id==2){
            return item.Method=='In';
        }else{
            return item.Method=='Out';
        }
    }
    $scope.init_data();

});
</script>
