<view ng-controller = "StoreCtrl">
<div class="col-sm-3 col-md-2 sidebar">
    <aside>
        <div class="list-group">
            <a href="#" class="list-group-item disabled">Stores</a>
            
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
        Stores
    </ul>
    <div style="padding: 0px 10px">                       
        <table>
            <tr ng-repeat="item in items">
                <td>{{item.ProductId}}</td>
                <td>{{item.StoreId}}</td>
            </tr>
        </table>
    </div>
</div>
</view>

<script>


angular.module("Warehouse-app").controller("StoreCtrl",function($scope,httpService){
	$scope.stores = [];
    $scope.current_store = {};
    $scope.items = [];
    var url = "<?php echo base_url('store/items')?>";
    httpService(url,{},function(json){
        if (json.status){
            $scope.stores = json.result;
        }
    });
    $scope.select_store =function(item){
        $scope.current_store = item;
        $scope.load_inventory();
    }
    $scope.load_inventory = function()
    {
        $scope.items = [];
        var url = "<?php echo base_url('inventory/items')?>";
        httpService(url,{storeId:$scope.current_store.Id},function(json){
            if (json.status){
                $scope.items = json.result;
                console.log($scope.items);
            }
        });
    } 
   

});
</script>
