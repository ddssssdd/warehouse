<view ng-controller = "StocksInCtrl">

    <!-- left right -->
<div class="col-sm-12" style="padding:0px;padding-top: 80px; ">
    <div class="text-right pull-right" style="padding-right: 10px;"> 
        <i class="fa fa-user"></i> <?php echo $user["name"] ?> [ Admin ], <a href="<?php echo base_url('home/logout')?>">注销</a>
    </div>
    <ul class='breadcrumb' id='breadcrumb'>
        <li><a href="#">首页</a></li>
    </ul>
    <div style="padding: 0px 10px"> 
        <div class="panel panel-default grid">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-th-list"></i> 入库单
                <div class="panel-tools">
                        <div class="btn-group">
                            <a href="" class="btn  btn-sm "><span class="glyphicon glyphicon-plus"></span> 添加细目</a>            </div>
                            <div class="badge">2</div>
                        </div>
                </div>
                <div class="panel-filter ">
                    <form class="form-inline" role="form" method="get">
                        <div class="form-group">
                            <label for="keyword" class="form-control-static control-label">入库单号</label>
                            <input class="form-control" type="text"  placeholder="入库单号码" ng-model="order.InvoiceNo">
                            <label for="keyword" class="form-control-static control-label">供应商</label>
                            <select class="form-control" ng-model="order.VendorId" 
                                ng-options="item.Id as item.Name for item in vendors">
                            </select>
                            <label  class="form-control-static control-label">入库日期</label>
                            <input class="form-control" type="text"  placeholder=""  ng-model="order.EnteredDate">
                            <br/>
                            <label for="keyword" class="form-control-static control-label">总价</label>
                            <input class="form-control" type="text"  placeholder="" ng-model="order.TotalPrice">
                            <label for="keyword" class="form-control-static control-label">总数量</label>
                            <input class="form-control" type="text"  placeholder="" ng-model="order.TotalNo">
                            <label for="keyword" class="form-control-static control-label">仓库</label>
                            <select class="form-control" ng-model="order.StoreId" 
                                ng-options="item.Id as item.Name for item in stores">
                                
                            </select>
                            <label for="keyword" class="form-control-static control-label">备注</label>
                            <input class="form-control" type="text"  placeholder=""  ng-model="order.Memo">
                            
                            </div>

                           
                        
                    </form>
                </div>
                <form method="post" id="form_list">
                    <div class="panel-body ">
                        <table class="table table-hover dataTable">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th></th>
                        <th>产品</th>
                        <th>规格</th>
                        <th>单价</th>
                        <th>数量</th>
                        <th>仓库</th>
                        <th>备注</th>
                        <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="detail in order.details">
                                <td>
                                <input type="checkbox" name="pid[]" ng-model="detail.checked">
                                </td>
                                <td> 
                                    <span class="glyphicon glyphicon-user"></span>
                                </td>
                                <td>
                                    {{detail.ProductId}}
                                </td>
                                <td>
                                    {{detail.Specification}}
                                </td>
                                <td>
                                    {{detail.Price}}
                                </td>
                                <td>
                                    {{detail.Quantity}}
                                </td>
                                <td>
                                    {{detail.StoreId}}
                                </td>
                                <td>
                                    {{detail.Memo}}
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-default btn-xs" ng-click="remove_detail($index,$event)">
                                    <span class="glyphicon glyphicon-remove"></span> 删除
                                </a>  
                                </td>
                            </tr>
                            <tr>
                            <td>
                                
                            </td>
                            <td> </td>
                            <td>
                                <select ng-model="detail.ProductId" ng-options="p.Id as p.Name for p in products">
                                </select>
                            </td>
                            <td>
                                <input type="text" ng-model="detail.Specification" />
                            </td>
                            <td>
                                <input type="number" ng-model="detail.Price" />
                            </td>
                            <td>
                                <input type="number" ng-model="detail.Quantity" />
                            </td>
                            <td>
                                <select ng-model="detail.StoreId" ng-options="s.Id as s.Name for s in stores">
                                </select>
                            </td>
                            <td>
                                <input type="text" ng-model="detail.Memo" />
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-default btn-xs" ng-click="add_detail(item,$event)">
                                    <span class="glyphicon glyphicon-edit"></span> 修改
                                </a>                            
                            </td>
                        </tr>
                    </tbody>
                </table>

                </div>
                <div class="panel-footer">
                    <div class="pull-left">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" ng-click="un_select($event)">
                                <span class="glyphicon glyphicon-ok"></span> 反选
                            </button>
                            <button class="btn btn-default"  ng-click="un_select($event)">
                                <span class="glyphicon glyphicon-lock"></span> 反设置禁止登录
                            </button>                        
                            <button class="btn btn-default"  ng-click="save($event)">
                                <span class="glyphicon glyphicon-save"></span> 保存入库单
                            </button>                    
                        </div>
                    </div>
                    <div class="pull-right">
                    </div>
                <div>
                
            </div>
        </div>

    </form>
</div>
        
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>友情提示</strong> Please believe in God.
        </div> 
                           
        
    </div>
</div>
</view>

<script>


angular.module("Warehouse-app").controller("StocksInCtrl",function($scope,httpService){
	$scope.products = [];
    $scope.vendors = [];
    $scope.stores = [];
    $scope.order = {Id:0,details:[]};
    $scope.detail = {Id:0,ProductId:0,Specification:'',Price:0.0,Quantity:0.0,StoreId:0};
    $scope.init_in = function(){
        var url1 = "<?php echo base_url('product/items')?>";
        httpService(url1,{},function(json){
            if (json.status){
                $scope.products = json.result;
            }
        });
        httpService(base_url+"/vendor/items",{},function(json){
            if (json.status){
                $scope.vendors = json.result;
            }
        });
        httpService(base_url+"/store/items",{},function(json){
            if (json.status){
                $scope.stores = json.result;
            }
        });
    }
    $scope.add_detail = function(event)
    {
        $scope.order.details.push($scope.detail);
        $scope.detail = {Id:0,ProductId:0,Specification:'',Price:0.0,Quantity:0.0,StoreId:0};
    }
    $scope.remove_detail = function(index,event){
        if ($scope.order.details){
            $scope.order.details.splice(index,1);
        }
    }
    $scope.save = function(event){
        console.log($scope.order);
        var url = base_url + "stocks/save";
        httpService(url,$scope.order,function(json){
            console.log(json);
            if (json.status){
                $scope.order = json.result;
            }
        });
    }
    $scope.new_product = function(event){
        
        if ($scope.new_item.name!=''){
            var url = base_url + "/product/add";
            httpService(url,$scope.new_item,function(json){
                console.log(json);
                if (json.status){
                    $scope.products = json.result;
                }
            });
        }
    }
    $scope.remove_product = function(event,product,index){
        var url = base_url + "/product/remove";
        httpService(url,{id:product.Id},function(json){
            if (json.status){
                $scope.products.splice(index,1);
            }
        });
    }
    $scope.init_in();

});
</script>
