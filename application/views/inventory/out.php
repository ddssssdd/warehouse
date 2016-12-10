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
        出库单
    </ul>
    <div style="padding: 0px 10px">                       
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
                            <td><a ng-href="<?php echo base_url('stocks/out'); ?>?id={{item.Id}}">{{item.EnteredDate}}</a></td>
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

angular.module("Warehouse-app").controller("StoreCtrl",function($scope,httpService){
	$scope.stores = [];
    $scope.current_store = {};
    $scope.products = [];
    $scope.stockIns = [];
    $scope.stockOuts = [];
    $scope.init_data = function()
    {
        //load outs; 
        httpService(base_url + "stocks/ItemsOut",{},function(json){
            if (json.status){
                $scope.stockOuts = json.result;
            }
        });   
    }
    
   
    $scope.init_data();
});
</script>
