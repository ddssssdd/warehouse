<view ng-controller = "StoreCtrl">
<div class="col-sm-3 col-md-2 sidebar">
    <aside>
        <div class="list-group">
            <a href="#" class="list-group-item disabled">仓库</a>
            
            <a href="<?php echo base_url('store/index') ?>?store_id={{item.Id}}"
                 class="list-group-item {{current_store.Id==item.Id?'current-active':''}}"
                 ng-repeat="item in stores">
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
        
    </ul>
    <div style="padding: 0px 10px"> 
        <h3 class="page-header">
                仓库管理
        </h3>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-th-list"></i> 编辑区域
                <div class="panel-tools">
                        <div class="btn-group">
                            <a href="" class="btn  btn-sm "><span class="glyphicon glyphicon-plus"></span> 添加细目</a>            </div>
                            <div class="badge">{{stores.length}}</div>
                        </div>
            </div>
            
            <div class="panel-filter ">
                <div class="form-group">
                    <table class="table dataTable">
                        <tr>
                            <td><label style="margin-top:10px;">名称</label></td>
                            <td><input type='text' ng-model="store.Name" placeholder="名称" class="form-control"></td>
                            <td><label style="margin-top:10px;">地址</label></td>
                            <td colspan="3"><input type='text' ng-model="store.Address" placeholder="地址" class="form-control"></td>
                            
                    </tr>
                    <tr>
                        <td><label style="margin-top:10px;">电话</label></td>
                        <td><input type='phone' ng-model="store.Phone" placeholder="电话" class="form-control"></td>

                        <td><label style="margin-top:10px;">传真</label></td>
                        <td><input type='text' ng-model="store.Fax" placeholder="传真" class="form-control"></td>

                        <td><label style="margin-top:10px;">管理员</label></td>
                        <td>
                            <select ng-model="store.Manager" ng-options="u.Id as u.Name for u in users" class="form-control">
                            </select>
                            
                        </td>
                                              
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                           
                        </td>  
                        <td></td>
                        <td></td>
                        
                        <td></td>
                        
                        <td colspan="3">
                            <a href="javascript:void(0);" ng-click="save_store($event)" class="btn btn-default btn-primary">
                                <span class="glyphicon glyphicon-plus"></span> {{store.Id>0?'保存修改':'新建'}}
                            </a>
                            <a href="javascript:void(0);" ng-click="cancel_edit($event)" class="btn btn-default btn-info">
                                <span class="glyphicon glyphicon-undo"></span> 取消
                            </a>
                        </td>
                    </tr>
                </table>
                </div>  
            </div>
            <div class="panel-body">
                <table class="table table-hover dataTable">
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
                        <tr ng-repeat="item in stores"  class="{{store.Id==item.Id?'danger':''}}">
                        <td>{{item.Id}}</td>
                        <td>{{item.Name}}</td>
                        <td>{{item.Address}}</td>
                        <td>{{item.Phone}}</td>
                        <td>{{item.Fax}}</td>
                        <td>{{find_user(item.Manager).Name}}</td>
                        <td>
                             <a href="javascript:void(0);" class="btn btn-primary btn-xs" ng-click="edit_item(item,$index,$event);">
                                <span class="glyphicon glyphicon-stop"></span> 编辑
                            </a>               
                            <a href="javascript:void(0);" ng-click="remove_store(item,$index,$event);" class="btn btn-danger btn-xs">
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


angular.module("Warehouse-app").controller("StoreCtrl",function($scope,httpService,Message){
	$scope.stores = [];
    $scope.users = [];
    $scope.store = {Id:0,Name:'',Address:'',Phone:'',Fax:'',Manager:0};
    $scope.orginal = {};
    $scope.init_data = function(){
        var url = "<?php echo base_url('store/items')?>";
        httpService(url,{},function(json){
            if (json.status){
                $scope.stores = json.result;
            }
        });
        url = base_url + "user/items";
        httpService(url,{},function(json){
            if (json.status){
                $scope.users = json.result;
            }
        });
    }
    
    $scope.save_store = function(event){
        if ($scope.store.Name!=''){
            var url = base_url + "/store/"+($scope.store.Id>0?'edit':'add');
            httpService(url,$scope.store,function(json){
                console.log(json);
                if (json.status){
                    $scope.stores = json.result;
                    $scope.store = {Id:0,Name:'',Address:'',Phone:'',Fax:'',Manager:0};
                }else{
                     Message.show(json.message);
                }
            });
        }
    }
    $scope.edit_item = function(item,index,event)
    {   item.original_index = index+1;
        $scope.original = angular.copy(item);    
        $scope.store = item;    
    }
    $scope.cancel_edit = function(event){
        if ($scope.store.original_index){
            $scope.stores[$scope.store.original_index-1] = $scope.original;
        }
        $scope.store = {Id:0,Name:'',Address:'',Phone:'',Fax:'',Manager:0};
    }
    $scope.remove_store = function(store,index,event){
        var url = base_url + "/store/remove";
        httpService(url,{Id:store.Id},function(json){
            if (json.status){
                $scope.stores.splice(index,1);
            }
        });
    }
    $scope.find_user = function(id){
        for(var i=0;i<$scope.users.length;i++){
            if (id==$scope.users[i].Id){
                return $scope.users[i];
            }
        }
        return {Id:0,Name:'未设置'};
    }
   $scope.init_data();

});
</script>
