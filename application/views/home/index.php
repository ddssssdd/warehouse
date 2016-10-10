<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?>
<div class='panel panel-default grid'>
    <div class='panel-heading'>
        <i class='glyphicon glyphicon-th-list'></i> 成员列表
        <div class='panel-tools'>

            <div class='btn-group'>
                
            </div>
            <div class='badge'>1</div>
        </div>
    </div>
    <div class='panel-filter '>
        <form class="form-inline" role="form" method="get">
            <div class="form-group">
                <label for="keyword" class="form-control-static control-label">关键词</label>
                <input class="form-control" type="text" name="keyword" value="<?php echo $keyword; ?>" id="keyword"
                       placeholder="请输入关键词"/></div>
            <button type="submit" name="dosubmit" value="搜索" class="btn btn-success"><i
                    class="glyphicon glyphicon-search"></i></button>
        </form>
    </div>
    <form method="post" id="form_list">

        
            <div class="alert alert-warning" role="alert"> 暂无数据显示... 您可以进行新增操作</div>
        
    </form>
</div>
</div>

<script language="javascript" type="text/javascript">
    var folder_name = "<?php echo $folder_name?>";
    require(['<?php echo SITE_URL?>scripts/common.js'], function (common) {
        require(['<?php echo SITE_URL?>scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/index.js']);
    });
</script>
