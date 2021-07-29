<div class="am-panel-hd">
    <h3 class="am-panel-title">网站信息配置</h3>
</div>


<div class="am-form-group">
    <label class="am-u-sm-2 am-form-label">初始账号:</label>
    <div class="am-u-sm-10">
        <input type="text" name="account" placeholder="管理员账号" required>
        <div class="am-alert am-alert-danger am-text-xs">
            本系统UID为1的账号默认是超级管理员，请妥善保管此账号！
        </div>
    </div>
</div>

<div class="am-form-group">
    <label class="am-u-sm-2 am-form-label">初始账号密码:</label>
    <div class="am-u-sm-10">
        <input type="text" name="password" placeholder="管理员密码" minlength="6" data-am-popover="{trigger:'focus', theme: 'warning sm', content: '请输入不小于6位数的密码'}" required>
    </div>
</div>

<div class="am-form-group">
    <label class="am-u-sm-2 am-form-label">再次确认密码:</label>
    <div class="am-u-sm-10">
        <input type="text" name="repassword" placeholder="再次确认密码" minlength="6" data-am-popover="{trigger:'focus', theme: 'danger sm', content: '请输入不小于6位数的密码'}" required>
    </div>
</div>


<div class="am-form-group">
    <label class="am-u-sm-2 am-form-label">初始账号名字:</label>
    <div class="am-u-sm-10">
        <input type="text" name="name" placeholder="管理员名字" required>
    </div>
</div>

<div class="am-form-group">
    <label class="am-u-sm-2 am-form-label">安全密钥:</label>
    <div class="am-u-sm-10">
        <div class="am-input-group">

            <input type="text" class="am-form-field pes-login-secret-key" name="secret_key" readonly required>
            <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default secret-key-refresh" type="button"><i class="am-icon-refresh"></i> 换一个</button>
                    </span>
        </div>
        <div class="am-alert am-alert-danger am-text-xs">
            请务必保存此安全密钥，当您忘记密码时，需凭此密钥找回密码！
        </div>
    </div>
</div>