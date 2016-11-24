<view ng-controller = "ProductCtrl">

    <!-- left right -->
<div class="col-sm-12" style="padding:0px;padding-top: 80px; ">
    <div class="text-right pull-right" style="padding-right: 10px;"> 
        <i class="fa fa-user"></i> <?php echo $user["name"] ?> [ Admin ], <a href="<?php echo base_url('home/logout')?>">注销</a>
    </div>
    <ul class='breadcrumb' id='breadcrumb'>
        products
    </ul>
    <div style="padding: 0px 10px"> 
        <h3 class="page-header">
            <a href="#" class="btn btn-info btn-sm pull-right">
                <span class="glyphicon glyphicon-plus"></span> 安装新模块</a>
                商品
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
                            <th>规格</th>
                            <th style="width:50px">单位</th>
                            <th style="width:50px">长度</th>
                            <th style="width:50px">宽度</th> 
                            <th style="width:50px">高度</th>
                            <th>品牌</th>
                            <th>条码</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in products">
                        <td>{{item.Id}}</td>
                        <td>{{item.Name}}</td>
                        <td>{{item.Specification}}</td>
                        <td>{{item.Unit}}</td>
                        <td>{{item.Length}}</td>
                        <td>{{item.Width}}</td>
                        <td>{{item.Height}}</td>
                        <td>{{item.Brand}}</td>
                        <td>{{item.Barcode}}</td>
                        <td>
                             <a href="javascript:void(0);" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-stop"></span> 编辑
                            </a>               
                            <a href="javascript:void(0);" ng-click="remove_product($event,item,$index);" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-remove"></span> 删除
                            </a>
                        </td>
                        </tr>
                        <tr>
                        <td></td>
                        <td><input type='text' ng-model="new_item.name" placeholder="名称"></td>
                        <td><input type='text' ng-model="new_item.specification" placeholder="规格"></td>
                        <td><input type='phone' ng-model="new_item.unit" placeholder="单位"></td>
                        <td><input type='text' ng-model="new_item.length" placeholder="长度"></td>
                        <td><input type='text' ng-model="new_item.width" placeholder="宽度"></td>
                        <td><input type='text' ng-model="new_item.height" placeholder="高度"></td>
                        <td><input type='text' ng-model="new_item.brand" placeholder="品牌"></td>
                        <td><input type='text' ng-model="new_item.barcode" placeholder="条码"></td>
                        
                        <td>
                                           
                            <a href="javascript:void(0);" ng-click="new_product($event)" class="btn btn-default btn-xs">
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


angular.module("Warehouse-app").controller("ProductCtrl",function($scope,httpService){
	$scope.products = [];
    $scope.current_product = {};
    $scope.items = [];
    $scope.new_item = {};
    var url = "<?php echo base_url('product/items')?>";
    httpService(url,{},function(json){
        if (json.status){
            $scope.products = json.result;
        }
    });
    $scope.select_product =function(item){
        $scope.current_product = item;
        $scope.load_inventory();
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
   

});
</script>
