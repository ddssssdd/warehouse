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
        <h3 class="page-header">
            <a href="#" class="btn btn-info btn-sm pull-right">
                <span class="glyphicon glyphicon-plus"></span> 安装新模块</a>
                仓库 
        </h3>
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>友情提示</strong> Please believe in God.
        </div> 
        <div class="panel panel-default">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>名称</th>
                            <th>地址</th>
                            <th>电话</th>
                            <th>传真</th>
                            <th>管理员</th> 
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in stores">
                        <td>{{item.Id}}</td>
                        <td>{{item.Name}}</td>
                        <td>{{item.Address}}</td>
                        <td>{{item.Phone}}</td>
                        <td>{{item.Fax}}</td>
                        <td>{{item.Manager}}</td>
                        <td>
                             <a href="javascript:void(0);" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-stop"></span> 编辑
                            </a>               
                            <a href="javascript:void(0);" ng-click="remove_store($event,item,$index);" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-remove"></span> 删除
                            </a>
                        </td>
                        </tr>
                        <tr>
                        <td></td>
                        <td><input type='text' ng-model="new_item.name"></td>
                        <td><input type='text' ng-model="new_item.address"></td>
                        <td><input type='phone' ng-model="new_item.phone"></td>
                        <td><input type='text' ng-model="new_item.fax"></td>
                        <td><input type='text' ng-model="new_item.manager"></td>
                        <td>
                                           
                            <a href="javascript:void(0);" ng-click="new_store($event)" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-plus"></span> 新建
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


angular.module("Warehouse-app").controller("StoreCtrl",function($scope,httpService){
	$scope.stores = [];
    $scope.current_store = {};
    $scope.items = [];
    $scope.new_item = {};
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
    $scope.new_store = function(event){
        //console.log($scope.new_item);
        if ($scope.new_item.name!=''){
            var url = base_url + "/store/add";
            httpService(url,$scope.new_item,function(json){
                console.log(json);
                if (json.status){
                    $scope.stores = json.result;
                }
            });
        }
    }
    $scope.remove_store = function(event,store,index){
        var url = base_url + "/store/remove";
        httpService(url,{id:store.Id},function(json){
            if (json.status){
                $scope.stores.splice(index,1);
            }
        });
    }
   

});
</script>
