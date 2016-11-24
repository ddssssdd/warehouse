<view ng-controller = "ClientCtrl">

    <!-- left right -->
<div class="col-sm-12" style="padding:0px;padding-top: 80px; ">
    <div class="text-right pull-right" style="padding-right: 10px;"> 
        <i class="fa fa-user"></i> <?php echo $user["name"] ?> [ Admin ], <a href="<?php echo base_url('home/logout')?>">注销</a>
    </div>
    <ul class='breadcrumb' id='breadcrumb'>
        clients
    </ul>
    <div style="padding: 0px 10px"> 
        <h3 class="page-header">
            <a href="#" class="btn btn-info btn-sm pull-right">
                <span class="glyphicon glyphicon-plus"></span> 安装新模块</a>
                供应商 
        </h3>
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>友情提示</strong> Please believe in God.
        </div> 
        <div class="panel panel-default">
            <div class="table-responsive">
                <table class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>名称</th>
                            <th>地址</th>
                            <th>电话</th>
                            <th>传真</th>
                            <th>邮箱</th> 
                            <th>联系人</th>
                            <th>手机</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in clients">
                        <td>{{item.Id}}</td>
                        <td>{{item.Name}}</td>
                        <td>{{item.Address}}</td>
                        <td>{{item.Phone}}</td>
                        <td>{{item.Fax}}</td>
                        <td>{{item.Email}}</td>
                        <td>{{item.ContactName}}</td>
                        <td>{{item.ContactCellphone}}</td>
                        <td>
                             <a href="javascript:void(0);" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-stop"></span> 编辑
                            </a>               
                            <a href="javascript:void(0);" ng-click="remove_client($event,item,$index);" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-remove"></span> 删除
                            </a>
                        </td>
                        </tr>
                        <tr>
                        <td></td>
                        <td><input type='text' ng-model="new_item.name" placeholder="名称"></td>
                        <td><input type='text' ng-model="new_item.address" placeholder="地址"></td>
                        <td><input type='phone' ng-model="new_item.phone" placeholder="电话"></td>
                        <td><input type='text' ng-model="new_item.fax" placeholder="传真"></td>
                        <td><input type='text' ng-model="new_item.email" placeholder="邮箱"></td>
                        <td>
                            <input type='text' ng-model="new_item.contactName" placeholder="联系人">
                        </td>
                        <td>
                            <input type='text' ng-model="new_item.contactCellphone" placeholder="手机">
                        </td>
                        <td>
                                           
                            <a href="javascript:void(0);" ng-click="new_client($event)" class="btn btn-default btn-xs">
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


angular.module("Warehouse-app").controller("ClientCtrl",function($scope,httpService){
	$scope.clients = [];
    $scope.current_client = {};
    $scope.items = [];
    $scope.new_item = {};
    var url = "<?php echo base_url('client/items')?>";
    httpService(url,{},function(json){
        if (json.status){
            $scope.clients = json.result;
        }
    });
    $scope.select_client =function(item){
        $scope.current_client = item;
        $scope.load_inventory();
    }
   
    $scope.new_client = function(event){
        
        if ($scope.new_item.name!=''){
            var url = base_url + "/client/add";
            httpService(url,$scope.new_item,function(json){
                console.log(json);
                if (json.status){
                    $scope.clients = json.result;
                }
            });
        }
    }
    $scope.remove_client = function(event,client,index){
        var url = base_url + "/client/remove";
        httpService(url,{id:client.Id},function(json){
            if (json.status){
                $scope.clients.splice(index,1);
            }
        });
    }
   

});
</script>
