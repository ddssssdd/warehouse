
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="/" ><div class="tsLogo "></div></a>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</div>
<div class="container">
    <form class="form-signin" role="form" action="<?php base_url("/home/login") ?>"  method="post" id="validateform" name="validateform">
        <div class="form-signin-body">

            <div class="form-group">
                <span class="input-group-addon" ><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" id="username" name="username" class="form-control" placeholder="请输入管理帐号" autofocus>
            </div>

            <div class="form-group">
                <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" id="password" name="password" class="form-control" placeholder="请输入管理密码"  autofocus>
            </div>

            <button class="btn  btn-primary btn-block" type="submit" id="dosubmit" > 登录</button>

            <div class="checkbox">
                <label>
                    <input type="checkbox" id="rmbUser" value="remember-me"> 在此设备上保存登录
                </label>
            </div>
        </div>
        <div class="form-signin-footer"> <a><i class="glyphicon glyphicon-question-sign"></i> 忘记密码？</a></div>
    </form>
