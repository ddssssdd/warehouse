<view ng-controller = "StoreCtrl">
<div class="col-sm-3 col-md-2 sidebar">
    <aside>
        <div class="list-group">
            <a href="#" class="list-group-item disabled">库房</a>
            
            <a href="javascript:void(0)"
                 class="list-group-item {{current_store.Id==item.Id?'current-active':''}}"
                 ng-repeat="item in stores"
                 ng-click="select_store(item);">
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
                            <th>描述</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in products">
                        <td>{{item.Id}}</td>
                        <td>{{item.Name}}</td>
                        <td>{{item.Specification}}</td>
                        <td>{{item.MinPrice | currency:'￥'}}</td>
                        <td>{{item.MaxPrice | currency:'￥'}}</td>
                        <td>{{item.MinOutPrice | currency:'￥'}}</td>
                        <td>{{item.MaxOutPrice | currency:'￥'}}</td>
                        <td>{{item.Quantity}}({{item.Unit}})</td>
                        <td>{{product_description(item)}}</td>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-th-list"></i> 入库清单
                <div class="panel-tools">

                    <div class="btn-group">
                        <a href="<?php echo base_url('stocks/in');?>" ng-click="reload($event);" class="btn  btn-sm "><span class="glyphicon glyphicon-edit"></span> 新建入库单</a>

                        
                    </div>
                    <div class="badge">{{stockIns.length}}</div>
                </div>
            </div>
            <div class="panel-body grid">
                <table class="table table-hover">
                    <thead>
                        <th>日期</th>
                        <th>供应商</th>
                        <th>发票号码</th>
                        <th>总价</th>
                        <th>总数量</th>
                        <th>备注</th>
                        <th>仓库</th>
                    </thead>
                    <tbody>
                        <tr ng-repeat = "item in stockIns">
                            <td>{{item.EnteredDate}}</td>
                            <td>{{item.VendorName}}</td>
                            <td>{{item.InvoiceNo}}</td>
                            <td>{{item.TotalPrice | currency:'¥'}}</td>
                            <td>{{item.TotalNo}}</td>
                            <td>{{item.Memo}}</td>
                            <td>{{item.StoreName}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
         <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-th-list"></i> 出库清单
                <div class="panel-tools">

                    <div class="btn-group">
                        <a href="<?php echo base_url('stocks/out');?>" ng-click="reload($event);" class="btn  btn-sm "><span class="glyphicon glyphicon-edit"></span> 新建出库单</a>

                        
                    </div>
                    <div class="badge">{{stockOuts.length}}</div>
                </div>
            </div>
            <div class="panel-body grid">
                <table class="table table-hover">
                    <thead>
                        <th>日期</th>
                        <th>客户</th>
                        <th>发票号码</th>
                        <th>总价</th>
                        <th>总数量</th>
                        <th>备注</th>
                    </thead>
                    <tbody>
                        <tr ng-repeat = "item in stockOuts">
                            <td>{{item.EnteredDate}}</td>
                            <td>{{item.ClientName}}</td>
                            <td>{{item.InvoiceNo}}</td>
                            <td>{{item.TotalPrice | currency:'¥'}}</td>
                            <td>{{item.TotalNo}}</td>
                            <td>{{item.Memo}}</td>
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
        //load ins
        httpService(base_url + "stocks/ItemsIn",{},function(json){
            if (json.status){
                $scope.stockIns = json.result;
            }
        });
        //load outs; 
        httpService(base_url + "stocks/ItemsOut",{},function(json){
            if (json.status){
                $scope.stockOuts = json.result;
            }
        });   
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
        return p.Unit+'-('+p.Length+','+p.Width+','+p.Height+')-'+p.Brand;
    }
    $scope.init_data();
});
</script>
