<view ng-controller = "StocksOutCtrl">

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
                <i class="glyphicon glyphicon-th-list"></i> 出库单
                <div class="panel-tools">
                        <div class="btn-group">
                            <a href="" class="btn  btn-sm "><span class="glyphicon glyphicon-plus"></span> 添加细目</a>            </div>
                            <div class="badge">2</div>
                        </div>
                </div>
                <div class="panel-filter ">
                    <form class="form-inline" role="form" method="get">
                        <div class="form-group">
                            <label for="keyword" class="form-control-static control-label">出库单号</label>
                            <input class="form-control" type="text"  placeholder="出库单号码" ng-model="order.InvoiceNo">
                            <label for="keyword" class="form-control-static control-label">客户</label>
                            <select class="form-control" ng-model="order.ClientId" 
                                ng-options="item.Id as item.Name for item in clients">
                            </select>
                            <label  class="form-control-static control-label">出库日期</label>
                            <input class="form-control" type="datetime"  placeholder=""  ng-model="order.EnteredDate">
                            <br/>
                            <label for="keyword" class="form-control-static control-label">总价</label>
                            <input class="form-control" type="number"  placeholder="" ng-model="order.TotalPrice">
                            <label for="keyword" class="form-control-static control-label">总数量</label>
                            <input class="form-control" type="number"  placeholder="" ng-model="order.TotalNo">                            
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
                        <th>仓库</th>
                        <th>产品</th>
                        <th>规格</th>
                        <th>单价</th>
                        <th>数量</th>
                        <th>合计</th>
                        
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
                                    {{find_store(detail.StoreId).Name}}
                                </td>
                                <td>
                                    {{detail.ProductName}}
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
                                    {{detail.Total}}
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
                                <select ng-model="detail.StoreId" ng-options="s.Id as s.Name for s in stores" ng-change="store_change($event)">
                                </select>
                            </td>
                            <td>
                                <select ng-model="detail.ProductId" ng-change="detail_change_product($event)" 
                                    ng-options="p.Id as p.Name for p in products">
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
                            </td>
                            
                            <td>
                                <input type="text" ng-model="detail.Memo" />
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-default btn-xs" ng-click="add_detail(item,$event)">
                                    <span class="glyphicon glyphicon-edit"></span> 增加细目
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
                                <span class="glyphicon glyphicon-lock"></span> Unknow
                            </button>                        
                            <button class="btn btn-default"  ng-click="save($event)">
                                <span class="glyphicon glyphicon-save"></span> 保存出库单
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


angular.module("Warehouse-app").controller("StocksOutCtrl",function($scope,httpService,Message){
	$scope.products = [];    
    $scope.clients = [];
    $scope.stores = [];
    $scope.order = {Id:0,details:[],ClientId:0,TotalPrice:0.0,TotalNo:0,Memo:'',InvoiceNo:''};
    $scope.detail = {Id:0,ProductId:0,Specification:'',Price:0.0,Quantity:0.0,StoreId:0,Memo:''};
    $scope.init_in = function(){
        
        httpService(base_url+"/client/items",{},function(json){
            if (json.status){
                $scope.clients = json.result;
            }
        });
        httpService(base_url+"/store/items",{},function(json){
            if (json.status){
                $scope.stores = json.result;
            }
        });
    }
    $scope.process_order = function (order){
        order.TotalPrice = order.TotalPrice*1;
        order.TotalNo = order.TotalNo*1;
        for(var i=0;i<order.details.length;i++){
            order.details[i].Price =order.details[i].Price *1;
            order.details[i].Quantity =order.details[i].Quantity *1;
            order.details[i].Toal =order.details[i].Quantity *order.details[i].Price;
        }
        $scope.order = order;
    }
    $scope.add_detail = function(event)
    {
        $scope.order.details.push($scope.detail);
        var sum = 0;
        var q = 0;
        for(var i=0;i<$scope.order.details.length;i++){
            var item = $scope.order.details[i];
            item.Total = item.Price * item.Quantity;
            sum += item.Total;
            q += item.Quantity;
        }
        $scope.order.TotalPrice = sum;
        $scope.order.TotalNo = q;
        $scope.detail = {Id:0,ProductId:0,Specification:'',Price:0.0,Quantity:0.0,StoreId:$scope.detail.StoreId,Memo:''};
    }
    $scope.remove_detail = function(index,event){
        if ($scope.order.details){
            $scope.order.details.splice(index,1);
        }
    }
    $scope.save = function(event){
        console.log($scope.order);
        var url = base_url + "stocks/save_out";
        httpService(url,$scope.order,function(json){
            console.log(json);
            if (json.status){
                $scope.process_order(json.result);
                Message.show("出库单存储成功！");
            }
        });
    }
    $scope.store_change = function(event)
    {
        //should load this store products only;
        var url = base_url + "stocks/products";
        httpService(url,{store_id:$scope.detail.StoreId},function(json){
            if (json.status){               
                $scope.products = json.result;
            }
        });
    }
    $scope.detail_change_product = function(event){
        var product = $scope.find_product($scope.detail.ProductId);
        if (product){
            $scope.detail.Price = product.Price*1;
            $scope.detail.Specification = product.Specification;
            $scope.detail.Quantity = 1;
            $scope.detail.ProductName = product.Name;
        }
        
    }
    $scope.find_product = function(id){
        var p = $scope.find_in_array($scope.products,id);
        if (p){
            return p;
        }else{
            return null;
        }
    }
    $scope.find_store = function(id){
        var s = $scope.find_in_array($scope.stores,id);
        if (s){
            return s;
        }else{
            return null;
        }
    }
    $scope.find_in_array = function(arr,Id)
    {
        for(var i=0;i<arr.length;i++){
            if (Id==arr[i].Id){
                return arr[i];
            }
        }
        return null;

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
