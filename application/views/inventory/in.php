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
        入库单
    </ul>
    <div style="padding: 0px 10px">                       
       
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
        
        //load ins
        httpService(base_url + "stocks/ItemsIn",{},function(json){
            if (json.status){
                $scope.stockIns = json.result;
            }
        });
        
    }
    
   
    $scope.init_data();
});
</script>
