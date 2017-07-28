<view ng-controller = "VendorCtrl">

    <!-- left right -->
<div class="col-sm-12" style="padding:0px;padding-top: 80px; ">
    <div class="text-right pull-right" style="padding-right: 10px;"> 
        <i class="fa fa-user"></i> <?php echo $user["name"] ?> [ Admin ], <a href="<?php echo base_url('home/logout')?>">注销</a>
    </div>
    <ul class='breadcrumb' id='breadcrumb'>
        
    </ul>
    <div style="padding: 0px 10px"> 
        <h3 class="page-header">
                供应商 
        </h3>
       
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-th-list"></i> 编辑区域
                <div class="panel-tools">
                        <div class="btn-group">
                            <a href="" class="btn  btn-sm "><span class="glyphicon glyphicon-plus"></span> 添加细目</a>            </div>
                            <div class="badge">{{vendors.length}}</div>
                        </div>
            </div>
            
            <div class="panel-filter ">
                <div class="form-group">
                    <table class="table dataTable">
                        <tr>
                            <td><label style="margin-top:10px;">名称</label></td>
                            <td><input type='text' ng-model="vendor.Name" placeholder="名称" class="form-control"></td>
                            <td><label style="margin-top:10px;">地址</label></td>
                            <td colspan="3"><input type='text' ng-model="vendor.Address" placeholder="地址" class="form-control"></td>
                            
                    </tr>
                    <tr>
                        <td><label style="margin-top:10px;">电话</label></td>
                        <td><input type='phone' ng-model="vendor.Phone" placeholder="电话" class="form-control"></td>

                        <td><label style="margin-top:10px;">传真</label></td>
                        <td><input type='text' ng-model="vendor.Fax" placeholder="传真" class="form-control"></td>

                        <td><label style="margin-top:10px;">邮箱</label></td>
                        <td><input type='text' ng-model="vendor.Email" placeholder="邮箱" class="form-control"></td>
                                              
                    </tr>
                    <tr>
                        <td><label style="margin-top:10px;">联系人</label></td>
                        <td>
                            <input type='text' ng-model="vendor.ContactName" placeholder="联系人" class="form-control">
                        </td>  
                        <td><label style="margin-top:10px;">手机</td>
                        <td><input type='text' ng-model="vendor.ContactCellphone" placeholder="手机" class="form-control"></td>
                        
                        <td></td>
                        
                        <td colspan="3">
                            <a href="javascript:void(0);" ng-click="save_vendor($event)" class="btn btn-default btn-primary">
                                <span class="glyphicon glyphicon-plus"></span> {{vendor.Id>0?'保存修改':'新建'}}
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
                <table class="table dataTable">
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
                        <tr ng-repeat="item in vendors" class="{{vendor.Id==item.Id?'danger':''}}">
                        <td>{{item.Id}}</td>
                        <td>{{item.Name}}</td>
                        <td>{{item.Address}}</td>
                        <td>{{item.Phone}}</td>
                        <td>{{item.Fax}}</td>
                        <td>{{item.Email}}</td>
                        <td>{{item.ContactName}}</td>
                        <td>{{item.ContactCellphone}}</td>
                        <td>
                             <a href="javascript:void(0);" class="btn btn-xs btn-info" ng-click="edit_item(item,$index,$event)">
                                <span class="glyphicon glyphicon-edit"></span> 编辑
                            </a>               
                            <a href="javascript:void(0);" ng-click="remove_vendor(item,$index,$event);" class="btn btn-danger btn-xs">
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


angular.module("Warehouse-app").controller("VendorCtrl",function($scope,httpService,Message){
	$scope.vendors = [];
    $scope.orginal = {};
    $scope.vendor = {Id:0,Name:'',Address:'',Phone:'',Fax:'',Email:'',ContactCellphone:'',ContactName:''};
    var url = "<?php echo base_url('vendor/items')?>";
    httpService(url,{},function(json){
        if (json.status){
            $scope.vendors = json.result;
        }
    });
   
    $scope.save_vendor = function(event){
        
        if ($scope.vendor.name!=''){
            var url = base_url + "/vendor/"+($scope.vendor.Id>0?'edit':'add');
            httpService(url,$scope.vendor,function(json){
                console.log(json);
                if (json.status){
                    $scope.vendors = json.result;
                    $scope.vendor = {Id:0,Name:'',Address:'',Phone:'',Fax:'',Email:'',ContactCellphone:'',ContactName:''};
                }else{
                     Message.show(json.message);
                }
            });
        }
    }
    $scope.edit_item = function(item,index,event)
    {
        item.original_index = index+1;
        $scope.original = angular.copy(item);    
        $scope.vendor = item;    
    }
    $scope.cancel_edit = function(event){
        if ($scope.vendor.original_index){
            $scope.vendors[$scope.vendor.original_index-1] = $scope.original;
        }
        $scope.vendor = {Id:0,Name:'',Address:'',Phone:'',Fax:'',Email:'',ContactCellphone:'',ContactName:''};
    }
    $scope.remove_vendor = function(vendor,index,event){
        var production = $scope.vendors[index];
        Message.confirm("请确认删除"+production.Name+"?",function(){
            var url = base_url + "/vendor/remove";
            httpService(url,{Id:vendor.Id},function(json){
                if (json.status){
                    $scope.vendors.splice(index,1);
                }
            });   
        });
        
    }
   

});
</script>
