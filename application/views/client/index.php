<view ng-controller = "ClientCtrl">

    <!-- left right -->
<div class="col-sm-12" style="padding:0px;padding-top: 80px; ">
    <div class="text-right pull-right" style="padding-right: 10px;"> 
        <i class="fa fa-user"></i> <?php echo $user["name"] ?> [ Admin ], <a href="<?php echo base_url('home/logout')?>">注销</a>
    </div>
    <ul class='breadcrumb' id='breadcrumb'>
        
    </ul>
    <div style="padding: 0px 10px"> 
        <h3 class="page-header">
                客户 
        </h3>
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>友情提示</strong> Please believe in God.
        </div> 
        <div class="panel panel-default grid">
             <div class="panel-heading">
                <i class="glyphicon glyphicon-th-list"></i> 编辑区域
                <div class="panel-tools">
                        <div class="btn-group">
                            <a href="" class="btn  btn-sm "><span class="glyphicon glyphicon-plus"></span> 添加细目</a>            </div>
                            <div class="badge">{{clients.length}}</div>
                        </div>
            </div>
            
            <div class="panel-filter ">
                <div class="form-group">
                    <table class="table dataTable">
                        <tr>
                            <td><label style="margin-top:10px;">名称</label></td>
                            <td><input type='text' ng-model="client.Name" placeholder="名称" class="form-control"></td>
                            <td><label style="margin-top:10px;">地址</label></td>
                            <td colspan="3"><input type='text' ng-model="client.Address" placeholder="地址" class="form-control"></td>
                            
                    </tr>
                    <tr>
                        <td><label style="margin-top:10px;">电话</label></td>
                        <td><input type='phone' ng-model="client.Phone" placeholder="电话" class="form-control"></td>

                        <td><label style="margin-top:10px;">传真</label></td>
                        <td><input type='text' ng-model="client.Fax" placeholder="传真" class="form-control"></td>

                        <td><label style="margin-top:10px;">邮箱</label></td>
                        <td><input type='text' ng-model="client.Email" placeholder="邮箱" class="form-control"></td>
                                              
                    </tr>
                    <tr>
                        <td><label style="margin-top:10px;">联系人</label></td>
                        <td>
                            <input type='text' ng-model="client.ContactName" placeholder="联系人" class="form-control">
                        </td>  
                        <td><label style="margin-top:10px;">手机</td>
                        <td><input type='text' ng-model="client.ContactCellphone" placeholder="手机" class="form-control"></td>
                        
                        <td></td>
                        
                        <td colspan="3">
                            <a href="javascript:void(0);" ng-click="save_client($event)" class="btn btn-default btn-primary">
                                <span class="glyphicon glyphicon-plus"></span> {{client.Id>0?'保存修改':'新建'}}
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
                            <th>邮箱</th> 
                            <th>联系人</th>
                            <th>手机</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in clients" class="{{client.Id==item.Id?'danger':''}}">
                        <td>{{item.Id}}</td>
                        <td>{{item.Name}}</td>
                        <td>{{item.Address}}</td>
                        <td>{{item.Phone}}</td>
                        <td>{{item.Fax}}</td>
                        <td>{{item.Email}}</td>
                        <td>{{item.ContactName}}</td>
                        <td>{{item.ContactCellphone}}</td>
                        <td>
                             <a href="javascript:void(0);" class="btn btn-default btn-xs btn-info" ng-click="edit_item(item,$index,$event)">
                                <span class="glyphicon glyphicon-edit"></span> 编辑
                            </a>               
                            <a href="javascript:void(0);" ng-click="remove_client(item,$index,$event);" class="btn btn-default btn-xs btn-danger">
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


angular.module("Warehouse-app").controller("ClientCtrl",function($scope,httpService){
	$scope.clients = [];
    $scope.current_client = {};
    $scope.items = [];
    $scope.client = {Id:0,Name:'',Address:'',Phone:'',Fax:'',Email:'',ContactCellphone:'',ContactName:''};
    var url = "<?php echo base_url('client/items')?>";
    httpService(url,{},function(json){
        if (json.status){
            $scope.clients = json.result;
        }
    });
   
    $scope.save_client = function(event){        
        if ($scope.client.name!=''){

            var url = base_url + "/client/"+($scope.client.Id>0?'edit':'add');
            httpService(url,$scope.client,function(json){
                
                if (json.status){
                    $scope.clients = json.result;
                }
            });
        }
    }
    $scope.edit_item = function(item,index,event)
    {
        console.log(item);    
        $scope.client = item;    
    }
    $scope.cancel_edit = function(event){
        $scope.client = {Id:0,Name:'',Address:'',Phone:'',Fax:'',Email:'',ContactCellphone:'',ContactName:''};
    }
    $scope.remove_client = function(client,index,event){
        var url = base_url + "client/remove";
        httpService(url,{id:client.Id},function(json){
            if (json.status){
                $scope.clients.splice(index,1);
            }
        });
    }
   

});
</script>
