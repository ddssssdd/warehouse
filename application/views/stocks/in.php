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
                            <div class="badge">{{order.details.length}}</div>
                        </div>
                </div>
                <div class="panel-filter ">
                    <div class="form-inline form-group">
                        <label for="keyword" class="form-control-static control-label">入库单号</label>
                        <input class="form-control" type="text"  placeholder="入库单号码" ng-model="order.InvoiceNo">
                        <label for="keyword" class="form-control-static control-label">供应商</label>
                        <select class="form-control" ng-model="order.VendorId" 
                            ng-options="item.Id as item.Name for item in vendors">
                        </select>
                        <label  class="form-control-static control-label">入库日期</label>
                        <input class="form-control" type="datetime"  placeholder=""  ng-model="order.EnteredDate">
                        <label for="keyword" class="form-control-static control-label">仓库</label>
                        <select class="form-control" ng-model="order.StoreId" ng-change="order_change_store($event)"
                            ng-options="item.Id as item.Name for item in stores">
                        </select>
                        
                    </div>  
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-bordered dataTable">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th></th>
                        <th>产品</th>
                        <th>规格</th>
                        <th>单价</th>
                        <th>数量</th>
                        <th>合计</th>
                        <th>仓库</th>
                        <th>备注</th>
                        <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="detail in order.details" ng-class="{'info':detail.ChangedId,'danger':detail.changed}">
                                <td>
                                <input type="checkbox" name="pid[]" ng-model="detail.checked">
                                </td>
                                <td> 
                                    <span class="glyphicon glyphicon-user"></span>
                                </td>
                                <td>
                                    {{find_product(detail.ProductId).Name}}
                                </td>
                                <td>
                                    {{detail.Specification}}
                                </td>
                                <td>
                                    {{detail.Price | currency:'￥'}}
                                </td>
                                <td>
                                    {{detail.Quantity}}
                                </td>
                                <td>
                                    {{detail.Total | currency:'￥'}}
                                </td>
                                <td>
                                    {{find_store(detail.StoreId).Name}}
                                </td>
                                <td>
                                    {{detail.Memo}}
                                </td>
                                
                                <td>
                                    <a ng-if="!detail.ChangedId" href="javascript:void(0)" class="btn btn-default" ng-click="remove_detail($index,$event)">
                                    <span class="glyphicon glyphicon-remove"></span> {{getActionTitle(detail)}}
                                    </a>  
                                </td>
                        </tr>
                        <tr>
                            <td>
                                
                            </td>
                            <td> </td>
                            <td>
                                <select ng-model="detail.ProductId" class="form-control" ng-change="detail_change_product($event)" 
                                    ng-options="p.Id as p.Name for p in products">
                                </select>
                            </td>
                            <td>
                                <input type="text" ng-model="detail.Specification" class="form-control"/>
                            </td>
                            <td>
                                <input type="number" ng-model="detail.Price" class="form-control"/>
                            </td>
                            <td>
                                <input type="number" ng-model="detail.Quantity" class="form-control"/>
                            </td>
                            <td>
                            </td>
                            <td>
                                <select ng-model="detail.StoreId" ng-options="s.Id as s.Name for s in stores" class="form-control">
                                </select>
                            </td>
                            <td>
                                <input type="text" ng-model="detail.Memo" class="form-control" />
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-default btn-primary" ng-click="add_detail(item,$event)">
                                    <span class="glyphicon glyphicon-edit"></span> 添加
                                </a>                            
                            </td>
                        </tr>
                    </tbody>
                    </table>

                </div>
                <div class="panel-filter ">
                    
                </div>
                <div class="panel-footer">
                    <div class="pull-left">
                        <div class="form-inline form-group">                        
                        <label for="keyword" class="form-control-static control-label">总价</label>
                        <input class="form-control" type="number"  placeholder="" ng-model="order.TotalPrice">
                        
                        <label for="keyword" class="form-control-static control-label">总数量</label>
                        <input class="form-control" type="number"  placeholder="" ng-model="order.TotalNo">
                        
                        <label for="keyword" class="form-control-static control-label">备注</label>
                        <input class="form-control" type="text"  placeholder=""  ng-model="order.Memo">
                    </div>  
                    </div>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" ng-click="un_select($event)">
                                <span class="glyphicon glyphicon-ok"></span> 反选
                            </button>
                            
                            <button class="btn btn-default"  ng-click="save($event)">
                                <span class="glyphicon glyphicon-save"></span> 保存入库单
                            </button>                    
                        </div>
                    </div>
               
                </div>
    
            </div>
        
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>友情提示</strong> Please believe in God.
        </div> 
                           
        
    </div>
</div>
</view>

<script>

var parameter_id = <?php echo $id; ?>;

angular.module("Warehouse-app").controller("StocksInCtrl",function($scope,httpService,Message){
	$scope.products = [];
    $scope.vendors = [];
    $scope.stores = [];
    $scope.order = {Id:0,details:[],VendorId:0,StoreId:0,TotalPrice:0.0,TotalNo:0,Memo:'',InvoiceNo:'',EnteredDate:new Date().Format("yyyy-MM-dd")};
    $scope.detail = {Id:0,ProductId:0,Specification:'',Price:0.0,Quantity:0.0,StoreId:0,Memo:''};
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
        $scope.order_id = parameter_id;
        if ($scope.order_id>0){
            httpService(base_url+"/stocks/stock_in",{id:$scope.order_id},function(json){
                if (json.status){
                    $scope.process_order(json.result);
                }
            });
        }

    }
    $scope.process_order = function (order){
        order.TotalPrice = order.TotalPrice*1;
        order.TotalNo = order.TotalNo*1;
        for(var i=0;i<order.details.length;i++){
            order.details[i].Price =order.details[i].Price *1;
            order.details[i].Quantity =order.details[i].Quantity *1;
            order.details[i].Total =order.details[i].Quantity *order.details[i].Price;
        }
        $scope.order = order;
        $scope.order_id = $scope.order.Id;
    }
    $scope.add_detail = function(event)
    {
        
        $scope.order.details.push($scope.detail);
        $scope.calculate_details();
        $scope.detail = {Id:0,ProductId:0,Specification:'',Price:0.0,Quantity:0.0,StoreId:$scope.order.StoreId,Memo:''};
    }
    $scope.calculate_details = function(){
        var sum = 0;
        var q = 0;
        for(var i=0;i<$scope.order.details.length;i++){
            var item = $scope.order.details[i];
            item.Total = item.Price * item.Quantity;
            sum += item.Total;
            q += item.Quantity;
            if (!item.Specification){
                item.Specification='';
            }
        }
        $scope.order.TotalPrice = sum;
        $scope.order.TotalNo = q;
    }
    $scope.remove_detail = function(index,event){
        if ($scope.order_id>0){
            var detail = $scope.order.details[index];
            if (detail.changed){
                detail.changed = 0;
                detail.Quantity = Math.abs(detail.Quantity);
            }else{
                if (detail.Id>0){
                    detail.changed = 1;
                    detail.Quantity = 0 - Math.abs(detail.Quantity);    
                }else{
                    if ($scope.order.details){
                        $scope.order.details.splice(index,1);
                    }
                }
                
            }
        }else{
            if ($scope.order.details){
                $scope.order.details.splice(index,1);
            }    
        }
        $scope.calculate_details();
        
    }
    $scope.getActionTitle = function(detail)
    {
        var result = "删除";
        if ($scope.order_id>0){
            if (detail.changed){
                result = "取消"
            }else{
                if (detail.Id>0){
                    result = "冲库"    
                }
            }
        }
        return result;

    }
    $scope.save = function(event){
        console.log($scope.order);
        var url = base_url + "stocks/save_in";
        httpService(url,$scope.order,function(json){
            console.log(json);
            if (json.status){
                $scope.process_order(json.result);
                Message.show("入库单存储成功！");
            }
        });
    }
    $scope.order_change_store = function(event)
    {
        $scope.detail.StoreId = $scope.order.StoreId;
    }
    $scope.detail_change_product = function(event){
        var product = $scope.find_product($scope.detail.ProductId);
        if (product){
            $scope.detail.Price = product.Price*1;
            $scope.detail.Specification = product.Specification;
            $scope.detail.Quantity = 1;
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
