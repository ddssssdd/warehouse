<view ng-controller = "StoreCtrl">
<div class="col-sm-3 col-md-2 sidebar">
    <aside>
        <div class="list-group">
            <a href="#" class="list-group-item disabled">仓库</a>
            
            <a href="javascript:void(0)"
                 class="list-group-item {{current_store.Id==item.Id?'current-active':''}}"
                 ng-repeat="item in stores"
                 ng-click="select_store(item);">
                 {{item.Name}}<i class="fa fa-chevron-right"></i>
            </a>
  
        </div> 
        <div class="list-group">
            <a href="#" class="list-group-item disabled">查看</a>
            
            <a href="<?php echo base_url('inventory/stocksin') ?>" class="list-group-item">
                 入库单<i class="fa fa-chevron-right"></i>
            </a>
            <a href="<?php echo base_url('inventory/stocksout') ?>" class="list-group-item">
                 出库单<i class="fa fa-chevron-right"></i>
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
        库房- {{current_store.Name}}
    </ul>
    <div style="padding: 0px 10px">                       
        <div class="panel panel-default grid">
             <div class="panel-heading">
                <i class="glyphicon glyphicon-th-list"></i> {{current_store.Name}} - 库存清单
                <div class="panel-tools">

                    <div class="btn-group">
                        
                        <a href="<?php echo base_url('store/manage');?>" ng-click="reload($event);" class="btn  btn-sm "><span class="glyphicon glyphicon-edit"></span> 管理</a>

                        
                    </div>
                    <div class="badge">{{products.length}}</div>
                    <div class="badge">
                        <input type="checkbox" ng-model="isShowHas"/>只显示有库存的
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>名称</th>
                            <th>规格</th>                            
                            <th>入库低价</th>
                            <th>入库高价</th>
                            <th>出库低价</th>
                            <th>出库高价</th> 
                            <th>库存</th>
                            <th>单位</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in products | filter:showFilter" ng-class="item.Quantity<=0.00?'info':''">
                        <td>{{item.Id}}</td>
                        <td>{{item.Name}}</td>
                        <td>{{item.Specification}}</td>
                        <td>{{item.MinPrice | currency:'￥'}}</td>
                        <td>{{item.MaxPrice | currency:'￥'}}</td>
                        <td>{{item.MinOutPrice | currency:'￥'}}</td>
                        <td>{{item.MaxOutPrice | currency:'￥'}}</td>
                        <td>{{item.Quantity}}</td>
                        <td>({{item.Unit}})</td>
                        <td>{{item.Barcode}}</td>
                        <td>
                             <a href="<?php echo base_url('store/detail') ?>?inventory_id={{item.InventoryId}}&product_id={{item.ProductId}}&store_id={{current_store.Id}}"  target="_blank" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-edit"></span> 细节
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
var STORE_ID = <?php echo $store_id ?>;

angular.module("Warehouse-app").controller("StoreCtrl",function($scope,httpService){
	$scope.stores = [];
    $scope.current_store = {};
    $scope.products = [];
    $scope.stockIns = [];
    $scope.stockOuts = [];
    $scope.isShowHas = false;

    $scope.init_data = function()
    {
        var url = "<?php echo base_url('store/items')?>";
        httpService(url,{},function(json){
            if (json.status){
                $scope.stores = json.result;
                if ($scope.stores.length>0){
                    var index = 0;
                    for(var i=0;i<$scope.stores.length;i++){
                        if (STORE_ID==$scope.stores[i].Id){
                            index = i;
                            break;
                        }
                    }
                    $scope.select_store($scope.stores[index]);
                }
            }
        });
        
    }
    $scope.showFilter =function(item){
        if ($scope.isShowHas){
            return item.Quantity >0.00;
        }
        return true;
    }
    $scope.select_store =function(item){
        $scope.current_store = item;
        $scope.load_inventory();
    }
    $scope.load_inventory = function()
    {
        $scope.products = [];
        var url = "<?php echo base_url('stocks/products')?>";
        httpService(url,{store_id:$scope.current_store.Id},function(json){
            if (json.status){
                $scope.products = json.result;
                console.log($scope.products);
            }
        });
    } 
    $scope.product_description = function(p)
    {
        return p.Unit;
        /*
        return (p.Unit?p.Unit:'')+'-('+(p.Length?p.Length:'0')+','+(p.Width?p.Width:'0')+','+(p.Height?p.Height:'0')+')-'+(p.Brand?p.Brand:'');
        */
    }
    $scope.init_data();
});
</script>
